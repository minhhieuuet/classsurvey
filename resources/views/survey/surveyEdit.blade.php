@extends('index')
@section('content')

    <br>
<div id="app" class="container-fluid">
  <h1 class="text-center">
    <input type="text" class="invi-input" v-model="surveyName" style="width:300px; ">
    <button class="btn btn-info btn-sm" onclick="this.parentNode.getElementsByClassName('invi-input')[0].focus()">
      <i class="fa fa-edit"></i>
    </button>
    <button type="submit" class="btn btn-success " style="margin-left:0px;" @click="setContentDefault()">Nội dung mặc định</button>
  </h1>



<table class="table table-hover" v-for="(field,indexField) in fields" :key="indexField">


    <tr>
        <th class="row" colspan="6">
          <!-- <h5>@{{indexField+1}}.@{{field.title}}</h5> -->
          <h5>@{{indexField+1}}. <input type="text" class="invi-input" v-model="field.title" > </h5>
          <!-- Edit button -->
          <button class="btn btn-info btn-sm" onclick="this.parentNode.getElementsByClassName('invi-input')[0].focus()">
            <i class="fa fa-edit"></i>
          </button>
          <!-- Delete button -->
          <button class="btn btn-danger btn-sm" @click="deleteField(indexField)">
            <i class="fa fa-times"  ></i>
          </button>

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
      <input type="text" class="invi-input" v-model="fields[indexField].options[index]">
      <div class="btn-group">

      <button class="btn btn-info btn-sm" onclick="this.parentNode.parentNode.getElementsByClassName('invi-input')[0].focus()" >
        <i class="fa fa-edit"></i>
      </button>

      <button class="btn btn-danger btn-sm" @click="deleteOption(indexField,index)">
        <i class="fa fa-times"></i>
      </button>
      </div>

    </td>
    <td><input type="radio" v-bind:name="field.title+indexField+index"></td>
    <td><input type="radio" v-bind:name="field.title+indexField+index"></td>
    <td><input type="radio" v-bind:name="field.title+indexField+index"></td>
    <td><input type="radio" v-bind:name="field.title+indexField+index"></td>
    <td><input type="radio" v-bind:name="field.title+indexField+index"></td>
  </tr>
<!--   Add option to existing field   -->
  <tr>
      <td class="form-group row" style="margin-left:2px;">

        <input type="text" placeholder="Nhập tiêu chí khảo sát" class="form-control col-md-8" v-model="fields[indexField].input" @keyup.enter="addOptionToExistingField(indexField)">

        <button class="btn btn-success btn-sm col-md-1" @click="addOptionToExistingField(indexField)" >
          <i class="fa fa-plus"></i>
        </button>
      </td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
  </tr>
</table>
<!--   Input field table -->
<table class="table table-hover">
  <tr>
    <th colspan="6">
      <h5 style="float:left;">@{{fields.length+1}}.</h5>

      <input type="text" style="width:500px;border-radius:5px;"  placeholder="Nhập tiêu đề trường đánh gíá" @keyup.enter="addNewField()" v-model="inputFieldTitle" >
      <button class="btn btn-success btn-sm" @click="addNewField()">
      <i class="fa fa-plus"></i>   Thêm
      </button>
    </th>

    <tr>
      <td></td>
      <td class="option">1</td>
      <td class="option">2</td>
      <td class="option">3</td>
      <td class="option">4</td>
      <td class="option">5</td>
    </tr>
<!--   input options   -->
   <tr v-for="(option,optionIndex) in inputOptions" :key="optionIndex">
     <td>
      <input type="text" class="invi-input" v-model="inputOptions[optionIndex]">
      <div class="btn-group">
        <button class="btn btn-info btn-sm" onclick="this.parentNode.parentNode.getElementsByClassName('invi-input')[0].focus()" >
          <i class="fa fa-edit"></i>
        </button>
        <button class="btn btn-danger btn-sm"  @click="deleteInputOption(optionIndex)">
            <i class="fa fa-times"></i>
        </button>
      </div>
     </td>
      <td><input type="radio"></td>
      <td><input type="radio"></td>
      <td><input type="radio"></td>
      <td><input type="radio"></td>
      <td><input type="radio"></td>
  </tr>

<!--      -->

    <tr>
       <td class="form-group row" style="margin-left:2px;">

        <input type="text" placeholder="Nhập tiêu chí khảo sát" class="form-control col-md-8" v-model="inputOption"
        @keyup.enter="addOptionToInputField()" >
        <button class="btn btn-success btn-sm col-md-1" @click="addOptionToInputField()" >
          <i class="fa fa-plus"></i>
        </button>
      </td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
  </tr>
  </tr>
</table>
<div class="row">
    <form action="{{url('admin/khao-sat/'.$survey['id'])}}" method="post" class="row col-md-12">
      @csrf
      {{method_field('put')}}
      <input type="hidden" name="name" v-bind:value="surveyName">
      <textarea  name="fields" cols="30" rows="10" style="display:none;">@{{fields}}</textarea>
      <button  class=" btn btn-success col-md-12" @click="saveSurvey()">Lưu khảo sát</button>
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
    surveyName: '<?php echo $survey['name'] ?>' ,
    inputFieldTitle:'',
    inputOption:'',
    inputOptions:[],
    fields:<?php echo $survey['content'] ?>
  }
},
methods:{
  setContentDefault(){
    axios.get('/api/default-survey').then(res =>{
      this.fields=res.data;
    })
  },
  deleteField (index){
    this.fields.splice(index,1);
  },
  deleteOption (fieldIndex,optionIndex){
    this.fields[fieldIndex].options.splice(optionIndex,1);
  }
  ,
  addOptionToExistingField (indexField){
    this.fields[indexField].options.push(this.fields[indexField].input);
    this.fields[indexField].input='';
  },
  addOptionToInputField (){
      this.inputOptions.push(this.inputOption);
      this.inputOption='';
  },
  addNewField (){
      if(this.inputFieldTitle == ''){
        alert("Tiêu đề không được để trống");
      }else{
        if(this.inputOptions.length == 0){
          alert("Phải có ít nhất một tiêu chí đánh giá");
        }else{
          let inputField = {title:this.inputFieldTitle,options:this.inputOptions};
          this.fields.push(inputField);
          this.inputFieldTitle = '';
          this.inputOptions = [];
          this.inputOption = '';
        }
      }
  },
  deleteInputOption (index){
    this.inputOptions.splice(index,1);
  }
  ,
  saveSurvey (){
    console.log(this.fields);
  }
}
})
  </script>
@endsection
