@extends('StudentLayout.master')
@section('content')
<div id="app" class="container-fluid">
  <h1 class="text-center">{{$survey['name']}}</h1>
<table class="table " v-for="(field,indexField) in fields" :key="indexField">


    <tr>
        <th class="row" colspan="6">
          <!-- <h5>@{{indexField+1}}.@{{field.title}}</h5> -->
          <h5>@{{indexField+1}}.@{{field.title}}  </h5>
        </th>
    </tr>

  <tr>
    <td></td>
    <td class="option">1</td>
    <td class="option">2</td>
    <td class="option">3</td>
    <td class="option">4</td>
    <td class="option">5</td>
  </tr>
  <!-- Lopp options in field -->
  <tr v-for="(option,index) in field.options" :key="index">
    <td>
      @{{option}}
    </td>
    <td><input type="radio" :checked="results[option]==1" v-bind:name="field.title+indexField+index" @click="setResult(option,1)"></td>
    <td><input type="radio" :checked="results[option]==2" v-bind:name="field.title+indexField+index" @click="setResult(option,2)"></td>
    <td><input type="radio" :checked="results[option]==3" v-bind:name="field.title+indexField+index" @click="setResult(option,3)"></td>
    <td><input type="radio" :checked="results[option]==4" v-bind:name="field.title+indexField+index" @click="setResult(option,4)"></td>
    <td><input type="radio" :checked="results[option]==5" v-bind:name="field.title+indexField+index" @click="setResult(option,5)"></td>
  </tr>
<!--   Add option to existing field   -->
  <tr>

      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
  </tr>
</table>

<div class="row">
    <form action="{{route('submitSurvey')}}" method="post" class="row col-md-12"   ref="form">
      @csrf
      <input type="hidden" name="course_id" value="{{$course['id']}}">
      <input type="hidden" name="survey_id" value="{{$survey['id']}}">
      <textarea style="display:none;" name="content" cols="30" rows="10" >@{{results}}</textarea>
      <button v-on:click.prevent="getResult()"  class=" btn btn-success col-md-12">Gửi đánh giá</button>
    </form>
</div>
<br>
</div>

  {{-- Vue script --}}
  <script>
  new Vue({
el:"#app",
data (){
  return {
    results:<?php if($result) {echo $result;} else {echo "{}";} ?>,
    inputFieldTitle:'',
    inputOption:'',
    inputOptions:[],
    fields:<?php echo $survey['content'] ?>,
    resultList:[]

  }
},
methods:{
  getResult (){
    var optionKeys = [];
    for(let field of this.fields){
      optionKeys = optionKeys.concat(field.options);

    }
    if(this.checkContain(optionKeys,Object.keys(this.results))){
      this.$refs.form.submit();
    }else{
      swal({
        title:"Lỗi",
        type:"error",
        text:"Bạn chưa hoàn thành khảo sát",
        showConfirmButton:false,
        timer:1500
      })
    }


  },
  setResult(option,score){
    this.$set(this.results,option,score);
  },
    checkContain (childArr,parentArr){
      let result = true;
      childArr.forEach( elem =>{
        if(parentArr.indexOf(elem) === -1){
          result = false;
        }
      });
      return result;
    }
}
,
mounted (){

}

})
  </script>
@endsection
