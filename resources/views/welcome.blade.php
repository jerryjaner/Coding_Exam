<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Coding Test Crud AJAX</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css' />
  <link rel='stylesheet'
    href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css' />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.css" />

</head>



<!-- Add Modal -->
<div class="modal fade" id="add_product" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Create Product</h5>
        {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close_modal"></button> --}}
      </div>
     
      <form action="{{ route('create_product') }}" method="POST" id="create_product" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="my-2">
            <label for="">Product Name</label>
            <input type="text" name="name" class="form-control" placeholder="">
            <span class="text-danger error-text name_error"></span>
          </div>

          <div class="my-2">
            <label for="">Product Unit</label>
            <input type="text" name="unit" class="form-control" placeholder="">
            <span class="text-danger error-text unit_error"></span>
          </div>

          <div class="my-2">
            <label for="">Product Price</label>
            <input type="number" step="any" name="price" class="form-control" placeholder="">
            <span class="text-danger error-text price_error"></span>
          </div>

          <div class="my-2">
            <label for="">Expiration Date</label>
            <input type="date" name="expiration_date" class="form-control" placeholder="">
            <span class="text-danger error-text expiration_date_error"></span>
          </div>

          <div class="my-2">
            <label for="">Available Inventory</label>
            <input type="number" name="available_inventory" class="form-control" placeholder="">
            <span class="text-danger error-text available_inventory_error"></span>
          </div>

          <div class="my-2">
            <label for="">Product Image</label>
            <input type="file" name="image" class="form-control">
            <span class="text-danger error-text image_error"></span>
          </div> 

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="close_modal">Close</button>
          <button type="submit" id="btnSubmit" class="btn btn-primary">Submit</button>
        </div>
      </form>

    </div>
  </div>
</div>

<body class="bg-light">
  <div class="container">
    <div class="row my-5">
      <div class="col-lg-12">
        <div class="card shadow">
          <div class="card-header  d-flex justify-content-between align-items-center">
            <h3 class="text-secondary">Manage Product</h3>
              <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_product">
              Add Product
            </button>
          </div>
          <div class="card-body" id="show_all_product">
            {{-- For the table  --}}
          </div>
        </div>
      </div>
    </div>
  </div>

{{-- EDIT --}}
<div class="modal fade" id="EditModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Create Product</h5>
        {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close_edit_modal"></button> --}}
      </div>
     
      <form action="{{route('update_product')}}" method="POST" id="edit_product" enctype="multipart/form-data">
          <input hidden  name="id" id="product_id">
        @csrf
        <div class="modal-body">
          <div class="my-2">
            <label for="">Product Name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="">
            <span class="text-danger error-text name_error"></span>
          </div>

          <div class="my-2">
            <label for="">Product Unit</label>
            <input type="text" name="unit" id="unit"  class="form-control" placeholder="">
            <span class="text-danger error-text unit_error"></span>
          </div>

          <div class="my-2">
            <label for="">Product Price</label>
            <input type="number" step="any" id="price"  name="price" class="form-control" placeholder="">
            <span class="text-danger error-text price_error"></span>
          </div>

          <div class="my-2">
            <label for="">Expiration Date</label>
            <input type="date" name="expiration_date" id="expiration_date"  class="form-control" placeholder="">
            <span class="text-danger error-text expiration_date_error"></span>
          </div>

          <div class="my-2">
            <label for="">Available Inventory</label>
            <input type="number" name="available_inventory" id="available_inventory"  class="form-control" placeholder="">
            <span class="text-danger error-text available_inventory_error"></span>
          </div>

          <div class="my-2">
            <label for="">Product Image</label>
            <input type="file" name="image" id=""  class="form-control">
          </div> 

          <div class="mt-2" id="image">
             

              
          </div> 

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="close_edit_modal">Close</button>
          <button type="submit" id="update_product_btn" class="btn btn-primary">Update</button>
        </div>
      </form>

    </div>
  </div>
</div>


<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  
  $(document).ready(function () {

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });


      //Fetching all the data from the database
      allproduct();
      function allproduct(){
          $.ajax({
              url: '{{ route('get_product') }}',
              method: 'GET',
              success: function(response) {
                  $("#show_all_product").html(response);
                  $("table").DataTable({
                      
                      "order": [[ 0, "asc" ]]
                      
                  });
              }
          });
      }

      $("#edit_product").on('submit',function(e) {

        e.preventDefault();
        $("#update_product_btn").text('Updating...');
        $('#update_product_btn').attr("disabled", true);
        var frm = this;

        $.ajax({

            url:$(frm).attr('action'),
            method:$(frm).attr('method'),
            data: new FormData(frm),
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            beforeSend: function(){
                //Before Sending The Form
                $(frm).find('span.error-text').text('')
            },

            success: function(response) {
                if (response.code == 0)
                {
                    $('#update_product_btn').removeAttr("disabled");
                    $.each(response.error, function(prefix, val){
                        $(frm).find('span.'+prefix+'_error').text(val[0]);
                    });
                    $('#update_product_btn').text('Update');
                }
                else
                {
                    $(frm)[0].reset();
                    $('#update_product_btn').removeAttr("disabled");
                    $("#update_product_btn").text('Update');
                  allproduct();
                    $("#EditModal").modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Updated Successfully',
                        showConfirmButton: false,
                        timer: 1700,
                      
                    })
                }
                //To Remove error message once the mocal close and open again
                $('#close_edit_modal').on('click', function () {
                    $(frm).find('span.error-text').text('')
                });
            }
        });

      });

      //Creating product
      $('#create_product').on('submit',function (e) {

          e.preventDefault();
          $("#btnSubmit").text('Submitting . . .');
          $('#btnSubmit').attr("disabled", true);

          var form = this; //FORM
          $.ajax({
              url:$(form).attr('action'),
              method:$(form).attr('method'),
              data: new FormData(form),
              processData: false,
              dataType: "json",
              contentType:false,
              beforeSend: function(){
                  //Before Sending The Form
                  $(form).find('span.error-text').text('')
              },
              success: function(response) {
                  if(response.code == 0)
                  {
                      $('#btnSubmit').removeAttr("disabled"); // removing disabled button
                      //The Error Message Will Append
                      $.each(response.error, function(prefix, val){
                          $(form).find('span.'+prefix+'_error').text(val[0]);
                      });
                      $('#btnSubmit').text('Submit');
                  }
                  else
                  {

                      $(form)[0].reset(); // TO REST FORM
                      $('#btnSubmit').removeAttr("disabled"); // removing disabled button
                      $('#btnSubmit').text('Submit');   //change the text to normal
                      allproduct();    // TO RELOAD THE TABLE
                      $("#add_product").modal('hide');

                      // SWEETALERT
                      Swal.fire({
                          icon: 'success',
                          title: 'Added Successfully',
                          showConfirmButton: false,
                          timer: 1700,
                          
                      })

                      
                  }

                  $('#close_modal').on('click', function () {
                    $(form).find('span.error-text').text('')
                });

              }
          });
      });

      //Getting all the data from the id choose
      $(document).on('click', '.edit_product', function(e) {
          e.preventDefault();
          let id = $(this).attr('id');
          $.ajax({
              url: '{{ route('edit_product') }}',
              method: 'get',
              data: {
                  id: id,
                  _token: '{{ csrf_token() }}'
              },

              success: function(response){

                  $("#product_id").val(response.id);
                  $("#name").val(response.name);
                  $("#unit").val(response.unit);
                  $("#price").val(response.price);
                  $("#available_inventory").val(response.available_inventory);
                  $("#expiration_date").val(response.expiration_date);
                  $("#image").html( `<img src="storage/product/images/${response.image}" class="img-fluid img-thumbnail" ">`);   

                  
              }
          });
      });

      $(document).on('click', '.delete_product', function(e) {
              e.preventDefault();
              let id = $(this).attr('id');
              let csrf = '{{ csrf_token() }}';
              var reader = new FileReader();
              Swal.fire({
                  title: 'Are you sure?',
                  text: "All the records of this product will be permanently deleted!",
                  icon: 'warning',
                  // iconColor: 'rgb(188 61 79)',
                  showCancelButton: true,
                  confirmButtonColor: '#bc3d4f',
                  confirmButtonText: 'Confirm delete!',
                  confirmButtonColor: '#bc3d4f',
              })
              .then((result) => {
                  if (result.isConfirmed) {
                      $.ajax({
                          url: '{{ route('delete') }}',
                          method: 'delete',
                          data: {
                              id: id,
                              _token: csrf
                          },
                          success: function(response) {
                              console.log(response);
                              allproduct();
                              Swal.fire({
                                  icon: 'success',
                                  title: 'Deleted Successfully.',
                                  showConfirmButton: false,
                                  timer: 1700,
                                  // timerProgressBar: true,
                                  // toast: true,
                                  // position: 'top',
                                  // iconColor: 'white',
                                  // customClass: {
                                  //     popup: 'colored-toast'
                                  // },
                              })
                          }
                      });
                  }
              })
          });

      
  });

</script>
</body>

</html>