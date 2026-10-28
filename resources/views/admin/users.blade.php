@extends('layouts.admin.admin')

@section('header_scripts')

<style>
	table a{
		color: black;
		text-decoration: none;
	}
	table a:hover{
		color: #3071a9;
		text-decoration: none;
	}
</style>

@endsection

@section('content')

<section class="section-padding">
	<div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
      	<table id="users" class="display dataTable" width="100%" cellspacing="0">
      		<thead>
      			<tr>
                <th>Nombre</th>
                <th>Username</th>
                <th>Email</th>
                <th>Administrator</th>
                <th>Creado</th>
                <th>Editado</th>
                <th>ID</th>
            </tr>
      		</thead>
      		<tfoot>
      			<tr>
                <th>Nombre</th>
                <th>Username</th>
                <th>Email</th>
                <th>Administrator</th>
                <th>Creado</th>
                <th>Editado</th>
                <td>ID</td>
            </tr>
      		</tfoot>      		  		
      	</table>
      </div>
    </div>
	</div>
</section>

@endsection

@section('scripts_footer')

<script>
      $(document).ready(function() {
        //$('#users').DataTable();
        $('#users').DataTable({
         "ajax": "/admin/users/all",
         "order": [[ 6, "desc" ]],
         "columns": [            
            { "data": "name" ,
            "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
              $(nTd).html("<a href='/admin/users/"+oData.id+"'>"+oData.name+"</a>");
              }
            },
            { "data": "username" },
            { "data": "email" },
            { "data": "administrator" },
            { "data": "created_at" },
            { "data": "updated_at" },
            { "data": "id" }                         
        ]
        });
      });
   </script>

@endsection