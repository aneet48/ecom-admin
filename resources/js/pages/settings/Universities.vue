<template>
    <div>
        <BreadCrumb />
        <PageHeader title="Colleges">
            <v-btn
                class="ma-2 action-btn"
                color="teal accent-4"
                dark
                @click="addNew"
            >
                <v-icon class="app-bar-icon">mdi-plus</v-icon>Add New
            </v-btn>
            <v-btn class="ma-2 action-btn" color="teal accent-4" dark>
                <input
                    type="file"
                    class="form-control"
                    :class="{ ' is-invalid': error.message }"
                    id="input-file-import"
                    name="file_import"
                    ref="import_file"
                    @change="onFileChange"
                />
                <div v-if="error.message" class="invalid-feedback"></div>
            </v-btn>
            <v-btn class="ma-2 action-btn" color="teal accent-4" dark>
                <JsonCSV
                    class="ma-2 action-btn"
                    color="teal accent-4"
                    dark
                    :data="all_colleges"
                >
                    Export
                    <v-icon dark>mdi-cloud-download</v-icon>
                </JsonCSV>
            </v-btn>
        </PageHeader>
        <v-container>
            <v-skeleton-loader type="table" v-if="loader"></v-skeleton-loader>

            <v-simple-table v-if="!loader">
                <template v-slot:default>
                    <thead>
                        <tr>
                            <th class="text-left">Name</th>
                            <th class="text-left">City</th>
                            <th class="text-left">Students</th>
                            <th class="text-left">Products</th>
                            <th class="text-left">Active</th>
                            <th class="text-left"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, i) in posts" :key="i">
                            <td>{{ item.name }}</td>
                            <td>{{ item.city.name }}</td>
                            <td>{{ item.students_count }}</td>
                            <td>{{ item.products_count }}</td>
                            <td>
                                <div v-if="item.active">
                                    <v-chip
                                        class="ma-2 chip"
                                        color="teal accent-4"
                                        >Active</v-chip
                                    >
                                </div>
                                <div v-if="!item.active">
                                    <v-chip
                                        class="ma-2 chip"
                                        color="grey accent-4"
                                        >Inactive</v-chip
                                    >
                                </div>
                            </td>
                            <td class="text-right">
                                <v-row class="d-none d-sm-block">
                                    <v-btn
                                        fab
                                        dark
                                        x-small
                                        color="teal accent-4"
                                        @click="edituniversity(item)"
                                    >
                                        <v-icon dark small>mdi-pencil</v-icon>
                                    </v-btn>
                                    <v-btn
                                        fab
                                        dark
                                        x-small
                                        color="pink"
                                        @click="deleteItem(item)"
                                    >
                                        <v-icon dark small
                                            >mdi-trash-can</v-icon
                                        >
                                    </v-btn>
                                </v-row>

                                <v-row class="d-sm-none">
                                    <v-menu>
                                        <template v-slot:activator="{ on }">
                                            <v-btn dark icon v-on="on">
                                                <v-icon light
                                                    >mdi-dots-vertical</v-icon
                                                >
                                            </v-btn>
                                        </template>

                                        <v-list>
                                            <v-list-item
                                                @click="edituniversity(item)"
                                            >
                                                <v-list-item-title
                                                    >Edit</v-list-item-title
                                                >
                                            </v-list-item>
                                            <v-list-item
                                                @click="deleteItem(item)"
                                            >
                                                <v-list-item-title
                                                    >Delete</v-list-item-title
                                                >
                                            </v-list-item>
                                        </v-list>
                                    </v-menu>
                                </v-row>
                            </td>
                        </tr>
                    </tbody>
                </template>
            </v-simple-table>
        </v-container>

        <v-row justify="center">
            <v-dialog v-model="dialog" persistent max-width="600px">
                <v-form ref="form" v-model="valid" lazy-validation>
                    <v-card>
                        <v-card-title>
                            <span class="headline">{{ modal_title }}</span>
                        </v-card-title>
                        <v-card-text>
                            <v-row>
                                <v-col cols="12">
                                    <v-text-field
                                        label="Name*"
                                        required
                                        v-model="m_name"
                                        :rules="nameRules"
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12">
                                    <v-autocomplete
                                        label="City"
                                        :items="cities"
                                        item-text="name"
                                        item-value="id"
                                        return-object
                                        v-model="m_city"
                                        :loading="iscitiesLoading"
                                        :rules="cityRules"
                                        :search-input.sync="searchCity"
                                    ></v-autocomplete>
                                </v-col>
                                <v-col cols="12">
                                    <v-checkbox
                                        v-model="m_active"
                                        label="Activate"
                                    ></v-checkbox>
                                </v-col>
                            </v-row>

                            <v-list
                                v-if="errors.length"
                                dense
                                class="error-text"
                            >
                                <v-subheader
                                    >Please look at these errors:</v-subheader
                                >
                                <v-list-item-group>
                                    <v-list-item
                                        v-for="(item, i) in errors"
                                        :key="i"
                                    >
                                        <v-list-item-content>
                                            <v-list-item-title
                                                v-html="item"
                                            ></v-list-item-title>
                                        </v-list-item-content>
                                    </v-list-item>
                                </v-list-item-group>
                            </v-list>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn light color="white " @click="closeDialog"
                                >Close</v-btn
                            >
                            <v-btn dark color="pink " @click="saveDialog"
                                >Save</v-btn
                            >
                        </v-card-actions>
                    </v-card>
                </v-form>
            </v-dialog>
        </v-row>

        <div class="text-center" v-if="currentPage && TotalPages">
            <v-pagination
                v-model="currentPage"
                :length="TotalPages"
                :total-visible="totalVisible"
            ></v-pagination>
        </div>

        <v-snackbar
            v-model="snackbar"
            :color="snackbarColor"
            :timeout="5000"
            :multi-line="multiLine"
        >
            {{ snackbarText }}
            <v-btn dark text @click="snackbar = false">Close</v-btn>
        </v-snackbar>

        <v-overlay :value="overlay">
            <v-progress-circular
                indeterminate
                color="teal"
            ></v-progress-circular>
        </v-overlay>
    </div>
</template>

<script>
import BreadCrumb from "../../components/BreadCrumb";
import PageHeader from "../../components/PageHeader";
import JsonCSV from "vue-json-csv";
export default {
    data() {
        return {
            error: {},
            import_file: "",
            all_colleges: [],
            posts: [],
            loader: true,
            dialog: false,
            modal_title: "Add New College",
            currentPage: 1,
            TotalPages: 0,
            totalVisible: 15,
            m_name: "",
            m_type: "add",
            valid: false,
            nameRules: [v => !!v || "Name is required"],
            cityRules: [v => !!v || "city is required"],
            snackbar: false,
            snackbarText: "",
            multiLine: true,
            errors: [],
            overlay: false,
            editItem: {},
            snackbarColor: "info",
            m_active: false,
            cities: [],
            iscitiesLoading: false,
            search: "",
            clubs: [
                { id: 1, name: "chelsea", test: "1" },
                { id: 2, name: "mu", test: "1" },
                { id: 3, name: "arsenal", test: "1" }
            ],
            m_city: { id: null, name: null },
            searchCity: null,
            timeout: null
        };
    },
    components: {
        BreadCrumb,
        PageHeader,
        JsonCSV
    },
    mounted() {
        this.loader = true;
        this.fetchuniversities();
        this.fetchAlluniversities();
        // this.fetchcities();
    },
    watch: {
        searchCity: function(val) {
            clearTimeout(this.timeout);

            var self = this;
            this.timeout = setTimeout(function() {
                self.iscitiesLoading = true;
                self.fetchcities(val);

                console.log("searching:", val);
            }, 1000);
        },
        currentPage: function(val) {
            //do something when the data changes.
            if (val) {
                this.loader = true;
                this.fetchuniversities();
            }
        }
    },
    methods: {
        onFileChange(e) {
            this.loader = true;
            this.import_file = e.target.files[0];
            var extension = this.import_file.type;
            if (extension == "text/csv") {
                this.proceedAction();
            } else {
                this.overlay = false;
                this.snackbarText = "Oops!! Upload csv file only.";
                this.snackbar = true;
                this.snackbarColor = "red";
                this.loader = false;
            }
        },
        proceedAction() {
            let formData = new FormData();
            formData.append("import_file", this.import_file);
            axios
                .post("/api/universities/import", formData, {
                    headers: { "content-type": "multipart/form-data" }
                })
                .then(response => {
                    this.$swal("Imported!", response.msg, "success");
                    this.overlay = true;
                    this.loader = false;
                    if (response.status === 200) {
                        // codes here after the file is upload successfully
                        this.fetchAlluniversities();
                        this.fetchuniversities();
                    }
                })
                .catch(error => {
                    this.loader = false;
                    // code here when an upload is not valid
                    this.unknownError();
                    console.log(error);
                });
        },
        addNew() {
            this.modal_title = "Add New College";
            this.m_type = "add";
            this.dialog = true;
        },

        edituniversity(item) {
            //   this.iscitiesLoading = true;
            this.modal_title = "Edit College";
            this.editItem = item;
            console.log(item.city_id);
            let city = item.city;
            //   let city = this.cities.find(item => item.id == city_id);
            this.cities = [{ id: city.id, name: city.name }];
            this.m_city = { id: city.id, name: city.name };
            this.m_name = item.name;
            this.m_active = item.active;
            this.m_type = "edit";
            this.dialog = true;
        },

        deleteItem(item) {
            this.$swal({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ff3860",
                // cancelButtonColor: "#fff",
                confirmButtonText: "Yes, delete it!"
            }).then(result => {
                if (result.value && item) {
                    this.overlay = true;
                    axios
                        .post(`api/university/delete/${item.id}`)
                        .then(res => {
                            let data = res.data;
                            if (data.error && data.msg) {
                                this.errors = data.msg;
                            } else {
                                this.$swal("Deleted!", data.msg, "success");
                                this.overlay = true;
                                this.fetchuniversities();
                            }
                        })
                        .catch(err => {
                            this.unknownError();
                            console.log(err);
                        });
                }
            });
        },

        saveDialog() {
            this.errors = [];
            let is_valid = this.$refs.form.validate();
            if (!is_valid) return;

            let api_url =
                this.m_type == "edit"
                    ? `api/university/${this.editItem.id}`
                    : "api/university";
            axios({
                method: "post",
                url: api_url,
                data: {
                    name: this.m_name,
                    active: this.m_active,
                    city_id: this.m_city.id
                }
            })
                .then(res => {
                    let data = res.data;
                    if (data.error && data.msg) {
                        this.errors = data.msg;
                    } else {
                        this.overlay = true;
                        this.snackbarColor = "success";

                        this.snackbarText = data.msg;
                        this.snackbar = true;
                        this.closeDialog();
                        this.fetchuniversities();
                    }
                })
                .catch(err => {
                    this.unknownError();

                    console.log(err);
                });
        },

        closeDialog() {
            this.resetValidation();
            this.resetForm();
            this.iscitiesLoading = false;

            this.dialog = false;
            this.m_active = false;
            this.editItem = {};
            this.errors = [];
        },

        resetForm() {
            this.$refs.form.reset();
        },

        resetValidation() {
            this.$refs.form.resetValidation();
        },

        fetchuniversities() {
            axios
                .get("/api/universities/true?page=" + this.currentPage)
                .then(res => {
                    this.overlay = false;
                    this.loader = false;
                    this.posts = res.data.data;
                    this.TotalPages = res.data.last_page;
                })
                .catch(err => {
                    this.unknownError();
                    console.log(err);
                });
        },
        fetchAlluniversities() {
            axios
                .get("/api/all-universities")
                .then(res => {
                    this.all_colleges = res.data.data;
                })
                .catch(err => {
                    this.unknownError();
                    console.log(err);
                });
        },
        fetchcities(val) {
            axios
                .get("/api/cities/search/" + val)
                .then(res => {
                    this.cities = res.data.data;
                    this.iscitiesLoading = false;
                })
                .catch(err => {
                    this.unknownError();
                    console.log(err);
                });
        },
        unknownError() {
            this.overlay = false;
            this.snackbarText =
                "Oops!! There was some error. Please try again later or report ";
            this.snackbar = true;
            this.snackbarColor = "red";
        }
    }
};
</script>

<style>
.action-btn:hover {
    text-decoration: none;
}
.error-text
    .theme--light.v-list-item:not(.v-list-item--active):not(.v-list-item--disabled) {
    color: red !important;
}
</style>
