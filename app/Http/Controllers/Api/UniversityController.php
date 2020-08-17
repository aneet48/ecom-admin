<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\University;
use App\City;
use App\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use DB;
class UniversityController extends Controller
{
    public function universities($show_all = false)
    {
        if (!$show_all) {
            $universities = University::with('city')->where('active', 1)->orderBy('name')->paginate(15);
        } else {
            $universities = University::with('city')->orderBy('name')->paginate(15);

        }
        return response()->json($universities);
    }

    public function alluniversities(){

        $universities = DB::table('universities')
            ->join('cities', 'cities.id', '=', 'universities.city_id')
            ->join('states', 'states.id', '=', 'cities.state_id')
            ->select('universities.*', 'cities.name as city','states.name as state')
            ->get();

        $data['data'] = $universities;
        //$universities = json_decode(json_encode($universities),true);
        return response()->json($data);  

    }
    public function university($id)
    {
        $university = University::find($id);
        return response()->json($university);

    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:universities,name,' . $id,
            'city_id' => 'required',
        ]);

        if ($validator->fails()) {
            return generate_response(true, $validator->errors()->all());
        }

        $university = University::where('id', $id)->update([
            'city_id' => $request->get('city_id'),
            'name' => $request->get('name'),
            'active' => $request->has('active') ? $request->get('active') : false,
            'slug' => Str::slug($request->get('name')),

        ]);
        $msg = $university ? 'College updated successfully' : "College not Found";
        $error = $university ? false : true;

        return generate_response($error, $msg);
    }

    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:universities,name',
            'city_id' => 'required',

        ]);

        if ($validator->fails()) {
            return generate_response(true, $validator->errors()->all());
        }

        $university = University::create([
            'city_id' => $request->get('city_id'),
            'name' => $request->get('name'),
            'active' => $request->has('active') ? $request->get('active') : false,
             'slug' => Str::slug($request->get('name')),
        ]);
        $msg = $university ? 'College created successfully' : "College not Found";
        $error = $university ? false : true;
        $body = [
            'university' => $university,
        ];

        return generate_response($error, $msg, $body);
    }

    public function delete($id)
    {

        $university = University::where('id', $id)->delete();
        $msg = $university ? 'College deleted successfully' : "College not Found";
        $error = $university ? false : true;

        return generate_response($error, $msg);
    }

    public function search($q)
    {
        $result = University::with('city', 'city.state')->where('name', 'like', '%' . $q . '%')->paginate(15);
        return response()->json($result);
    }

    public function searchGlobal($q)
    {
        $result = University::with('city', 'city.state')
            ->where('name', 'like', '%' . $q . '%')
            ->where('active', '!=', 0)
            ->take(30)->get();
        return response()->json($result);
    }
    
    public function import(Request $request)
    {
            $file = $request->file('import_file');          
            $colleges = $this->csvToArray($file);
          
            for ($i = 0; $i < count($colleges); $i ++)
            {
                $college_slug =  Str::slug($colleges[$i]['college_name']);
                $exist = University::where(['slug'=>$college_slug])->first();
                $exist = json_decode(json_encode($exist),true);

                if($colleges[$i]['active']==0 || $colleges[$i]['active']==1){
                    $status = $colleges[$i]['active'];
                }else{
                    $status = 0;
                }
              
                if(empty($exist)){        
                           
                    $stateData = State::where(['name'=>$colleges[$i]['state']])->first();
                    if(!empty($stateData)){
                        $cityData = City::where(['name'=>$colleges[$i]['city']])->first();
                        if(empty($cityData)){                      
                            $cityData = City::create([
                                'state_id' => $stateData->id,
                                'name' =>$colleges[$i]['city'],
                                'active' => 1,
                            ]);
                        }

                        $university = University::create([
                            'city_id' => $cityData->id,
                            'name' =>$colleges[$i]['college_name'],
                            'active' => $status,
                            'slug' =>$college_slug,
                        ]);
                    }
                }else{
                    $cityData = City::where(['name'=>$colleges[$i]['city']])->first();
                    if(!empty($cityData)){
                       //if college already exist then only update city and status
                        $university = University::where('id', $exist['id'])->update([
                            'city_id' => $cityData->id,
                            'active' => $status,
                        ]);
                    }
                    
                }
            }
             return generate_response('false', 'College CSV file import successfully', []);
    }
    public function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }


}
