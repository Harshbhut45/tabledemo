@extends('layouts.app')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')

        <div class="content">
        <!-- Full Table -->
            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Product List</h3>
                    <a href="{{ route('products.create') }}" class="btn btn-alt-primary" title="View">Create Product
                    </a>
                </div>
                <button style="margin-bottom: 10px" class="btn btn-primary delete_all" data-url="{{ url('myproductsDeleteAll') }}">Delete All Selected</button>
                <div class="block-content">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-vcenter js-dataTable-full datatables">
                            <thead>
                                <tr>
                                    <th width="50px"><input type="checkbox" id="master"></th>
                                    <th class="text-center">Id</th>
                                    <th class="text-center">NAME</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Upc</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Image</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($products as $user)
                    
                                <tr>
                                    <td><input type="checkbox" class="sub_chk" data-id="{{$user->id}}"></td>
                                    <td class="text-center"> {{ $user->id }} </td>
                                    <td class="text-center"> {{ $user->name }} </td>
                                    <td class="text-center"> {{ $user->price }} </td>
                                    <td class="text-center"> {{ $user->upc }} </td>
                                    <td class="text-center"> {{ $user->status }} </td>
                                    <td class="text-center">  <img src="{{asset('website/adminproduct/products/'.$user->image)}}" height="50px" width="50px"> </td>
                                
                                                                
                                    <td class="text-center">
                                        <a class="btn btn-sm "  href="{{ route('products.edit',$user->id) }}"> <i class="fa fa-edit text-white-op" style="color:#000!important;"></i></a>
                                        <a class="btn btn-sm"  href="{{ route('products.delete',$user->id) }}"> <i class="fa fa-trash text-white-op" style="color:#000!important;"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END Full Table -->

            <!-- View Modal -->
            <div class="modal fade" id="viewClientModal" tabindex="-1" role="dialog" aria-labelledby="viewClientModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="viewClientModalLabel">View Client</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End View Modal -->
        </div>



        <script type="text/javascript">
            $(document).ready(function () {
        
                $('#master').on('click', function(e) {
                 if($(this).is(':checked',true))  
                 {
                    $(".sub_chk").prop('checked', true);  
                 } else {  
                    $(".sub_chk").prop('checked',false);  
                 }  
                });
        
        
                $('.delete_all').on('click', function(e) {
        
        
                    var allVals = [];  
                    $(".sub_chk:checked").each(function() {  
                        allVals.push($(this).attr('data-id'));
                    });  
        
        
                    if(allVals.length <=0)  
                    {  
                        alert("Please select row.");  
                    }  else {  
        
        
                        var check = confirm("Are you sure you want to delete this row?");  
                        if(check == true){  
        
        
                            var join_selected_values = allVals.join(","); 
        
        
                            $.ajax({
                                url: $(this).data('url'),
                                type: 'DELETE',
                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                data: 'ids='+join_selected_values,
                                success: function (data) {
                                    if (data['success']) {
                                        $(".sub_chk:checked").each(function() {  
                                            $(this).parents("tr").remove();
                                        });
                                        alert(data['success']);
                                    } else if (data['error']) {
                                        alert(data['error']);
                                    } else {
                                        alert('Whoops Something went wrong!!');
                                    }
                                },
                                error: function (data) {
                                    alert(data.responseText);
                                }
                            });
        
        
                          $.each(allVals, function( index, value ) {
                              $('table tr').filter("[data-row-id='" + value + "']").remove();
                          });
                        }  
                    }  
                });
        
        
                $('[data-toggle=confirmation]').confirmation({
                    rootSelector: '[data-toggle=confirmation]',
                    onConfirm: function (event, element) {
                        element.trigger('confirm');
                    }
                });
        
        
                $(document).on('confirm', function (e) {
                    var ele = e.target;
                    e.preventDefault();
        
        
                    $.ajax({
                        url: ele.href,
                        type: 'DELETE',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        success: function (data) {
                            if (data['success']) {
                                $("#" + data['tr']).slideUp("slow");
                                alert(data['success']);
                            } else if (data['error']) {
                                alert(data['error']);
                            } else {
                                alert('Whoops Something went wrong!!');
                            }
                        },
                        error: function (data) {
                            alert(data.responseText);
                        }
                    });
        
        
                    return false;
                });
            });
        </script>
@endsection

