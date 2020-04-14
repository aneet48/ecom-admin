<template>
   <div >
      <BreadCrumb/>
      <ComingSoon/>
  </div>
</template>

<script>
import Sidebar from "../components/Sidebar";
import BreadCrumb from "../components/BreadCrumb";
import ComingSoon from "../components/ComingSoon";

export default {
    components: {
        Sidebar,BreadCrumb,ComingSoon
    },
    props: {
        source: String
    },
    data: () => ({
        drawer: null
    })
};
</script>

<style  scoped>
.app-bar{
    width: 100%;
}
.app-bar-icon{
  border-left: 1px solid #f5efef;
    padding-left: 18px;
    padding-right: 18px;
    font-size: 18px;
}
#dashboard{
    background-color: #f8f8f8;
    font-family: Nunito, sans-serif;
}
.drawer{
    background: #2e323a;
}
</style>
