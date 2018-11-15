@extends('index')
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
    <td><input type="radio" v-bind:name="field.title+indexField+index" @click="resultList[indexField].scores[index]=1"></td>
    <td><input type="radio" v-bind:name="field.title+indexField+index" @click="resultList[indexField].scores[index]=2"></td>
    <td><input type="radio" v-bind:name="field.title+indexField+index" @click="resultList[indexField].scores[index]=3"></td>
    <td><input type="radio" v-bind:name="field.title+indexField+index" @click="resultList[indexField].scores[index]=4"></td>
    <td><input type="radio" v-bind:name="field.title+indexField+index" @click="resultList[indexField].scores[index]=5"></td>
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
    {{-- <form action="{{url('admin/khao-sat')}}" method="post" class="row col-md-12">
      @csrf
      <textarea  name="fields" cols="30" rows="10" style="display:none;">@{{fields}}</textarea> --}}
      <button  class=" btn btn-success col-md-12" @click="getResult()">Gửi đánh giá</button>
    {{-- </form> --}}
</div>
<br>
</div>

  {{-- Vue script --}}
  <script>
  new Vue({
el:"#app",
data (){
  return {
    results:[],
    inputFieldTitle:'',
    inputOption:'',
    inputOptions:[],
    fields:<?php echo $survey['content'] ?>
    ,
  resultList:[]

  }
},
methods:{
  getResult (){
    console.log(this.resultList);
  }
},
mounted (){
  this.resultList = this.fields.map(field =>{
    return {scores:[]}
  });
}

})
  </script>
@endsection
