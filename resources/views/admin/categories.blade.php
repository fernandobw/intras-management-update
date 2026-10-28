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
                <th>Alias</th>
                <th>Publicado</th>
                <th>ID</th>
            </tr>
      		</thead>
      		<tfoot>
      			<tr>
                <th>Nombre</th>
                <th>Alias</th>
                <th>Publicado</th>
                <th>ID</th>
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
        var csrf = '<?php echo csrf_field(); ?>';
        $('#users').DataTable({
         "ajax": "/admin/categories/all",
         "order": [[ 3, "desc" ]],
         "columns": [            
            { "data": "name" ,
            "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
              $(nTd).html("<a href='/admin/categories/"+oData.id+"'>"+oData.name+"</a>");
              }
            },
            { "data": "alias" },
            { "data": "published" ,
            "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
              if (oData.published == '1')
              {
                $(nTd).html("<form action='/admin/categories/" + oData.id + "/update/published' method='post'>" + csrf + "<button type='submit' style='font-size: 11px;'><i class='fa fa-check' style='color: #3E843E;'></i></button></form>");
              }
              else
              {
                $(nTd).html("<form action='/admin/categories/" + oData.id + "/update/published' method='post'>" + csrf + "<button type='submit' style='font-size: 11px;'><i class='fa fa-times-circle' style='color: #A52A25;'></i></button></form>");                
              }

              }
            },
            { "data": "id" }         
        ]
        });
      });
   </script>

@endsection