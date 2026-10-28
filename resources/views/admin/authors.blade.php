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
      	<table id="authors" class="display dataTable" width="100%" cellspacing="0">
      		<thead>
      			<tr>
                <th id="thNombre">Nombre</th>
                <th>ID</th>
                <th>Eliminar</th>               
            </tr>
      		</thead>
      		<tfoot>
      			<tr>
                <th>Nombre</th>              
                <td>ID</td>
                <th>Eliminar</th>
            </tr>
      		</tfoot>      		  		
      	</table>
      </div>
    </div>
	</div>
</section>

<div class="modal fade" id="authorDeleteModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Eliminar autor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>¿Está seguro que desea eliminar a <span id="modalAuthorName"></span> ?</p>
      </div>
      <div class="modal-footer">
       <form action="{{ url('/admin/authors') }}" method="POST" enctype="multipart/form-data" id="modalFormSubmit">
        @csrf
        <button type="submit" class="btn btn-danger">Eliminar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
       </form>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts_footer')

<script>
      $(document).ready(function() {
      //$('#users').DataTable();

          $(document).on("click",".delete", function () {

           var id = $(this).data('id');
           var name = $(this).data('name');
           var action = "{{ url('/admin/authors/') }}/" + id + "/delete";

           $("#modalAuthorName").text(name);
           $("#modalFormSubmit").attr("action",action);


          });

       

       $('#authors').DataTable({
         "ajax": "/admin/authors/all",
         "order": [[ 1, "desc" ]],
         "columns": [            
            { "data": "userName" ,
            "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
              $(nTd).html("<a href='/admin/authors/"+oData.userID+"'>"+oData.userName+"</a>");
              }
            },
            { "data": "userID" },
            { 
              data: null,
               "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
              $(nTd).html('<a class="btn btn-default delete" id="asd" data-toggle="modal" data-target="#authorDeleteModal" style="font-size: 11px;" data-id="' + oData.userID + '" data-name="' + oData.userName + '"><i class="fa fa-trash" style="color: #A52A25;font-size: 15px;"></i></a>');
              }
            }                         
        ]
        });
      });
   </script>

@endsection