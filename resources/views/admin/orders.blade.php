@extends('layouts.admin')

@section('content')
<div id="main-page">
  <div class="alert alert-danger" id="generic-error" style="display: none">
    <b>There is an error happend while loading the page, please resfresh the page !!</b>
  </div><!-- /.alert -->

  <!-- latest Order -->
  <div class="panel panel-default users-table togglePanle" style="display: !none">
    <div class="panel-heading main-color-bg clearfix">
      <h3 class="panel-title pull-left" style="margin-top:5px;">Orders</h3>
      <button type="button" class="pull-right btn btn-default btn-sm table-toggle" data-target=".create-category">
        <span class="glyphicon glyphicon-plus"></span> Create Order
      </button>
    </div>

    <div class="panel-body panal-body-container">

      <div class="alert alert-danger" id="delete-category-failed" style="display: none">
        <b>Order deleted request failed please refresh the page !!</b>
      </div><!-- /.alert -->

      <div class="alert alert-warning" id="delete-category-success" style="display: none">
        <b>Order was successfuly deleted !!</b>
      </div><!-- /.alert -->

      <table class="table table-striped table-hover" id="category-table">
        <tr id="table-header">
          <th class="text-center">Name</th>
          <th class="text-center">Category</th>
          <th class="text-center">User</th>
          <th class="text-center">Price</th>
          <th class="text-center">Quantity</th>
          <th class="text-center">Date</th>
          <th class="text-center" style="width: 150px;">Control</th>
        </tr>
      </table>
    </div><!-- /.panel-body -->
  </div><!-- /.panel -->

  <!-- Create new Order -->
  <div class="panel panel-default create-category togglePanle" style="display: none">
    <div class="panel-heading main-color-bg clearfix">
      <h3 class="panel-title pull-left" style="margin-top:5px;">Create New Order</h3>
      <button type="button" class="pull-right btn btn-default btn-xs table-toggle" data-target=".users-table">
        <span class="glyphicon glyphicon-remove" data-target=".users-table"></span> close
      </button>
    </div>

    <div class="panel-body">
        <!-- message alwer -->
        <div class="alert alert-success" id="create-category-suceess" style="display: none">
          <b>A new Order was created successfuly !!</b>
        </div><!-- /.alert -->

        <form id="createCategoryForm">
          <div class="panel-body" style="min-height: 250px; overflow-y: scroll">

            <div class="form-group">
              <h4>Products</h4>
              <input class="form-control" id="productCode" placeholder="Search product by code">
            </div><!-- /.form-group -->

            <table class="table">
              <tr>
                <th class="text-center">Name</th>
                <th class="text-center">Category</th>
                <th class="text-center">Price</th>
                <th class="text-center">Code</th>
                <th class="text-center">Control</th>
              </tr>
              @foreach($products as $product)
              <tr class="text-center product-row" data-code="{{$product->code}}">
                <td>{{$product->name}}</td>
                <td>{{$product->category_name}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->code}}</td>
                <td>
                  <input type="radio" value="{{$product->id}}" name="product" required="required">
                  <button class="btn btn-primary btn-xs show-row" data-id="{{$product->id}}">
                    <i class="fa fa-info-circle show-row" data-id="{{$product->id}}" aria-hidden="true"></i>
                  </button>
                </td>
              </tr>
              @endforeach
            </table>
          </div><!-- /.card -->

          <div class="panel-body" style="min-height: 250px; overflow-y: scroll">

            <div class="form-group">
              <h4>Users</h4>
              <input class="form-control" id="userEmail" placeholder="Search user by email">
            </div><!-- /.form-group -->

            <table class="table">
              <tr>
                <th class="text-center">Name</th>
                <th class="text-center">Email</th>
                <th class="text-center">Joined</th>
                <th class="text-center">Control</th>
              </tr>
              @foreach($users as $user)
                @if($user->category != 'technical')
                <tr class="text-center user-row" data-email="{{$user->email}}">
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{explode(' ', $user->created_at)[0]}}</td>
                  <td>
                    <input type="radio" name="user" value="{{$user->id}}" required="required">
                  </td>
                </tr>
                @endif
              @endforeach
            </table>
          </div><!-- /.card -->

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
    </div><!-- /.panel-body -->
  </div><!--/.panel -->

  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Modal title</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <img class="img-thumbnail" id="showImg" style="width: 100%">
          </div><!-- /.form-group -->

          <div class="form-group">
            <label>Categoey</label>
            <input class="form-control" id="showCategoey" disabled="disabled">
          </div><!-- /.form-group -->

          <div class="form-group">
            <label>Name</label>
            <input class="form-control" id="showName" disabled="disabled">
          </div><!-- /.form-group -->

          <div class="form-group">
            <label>Quantity</label>
            <input class="form-control" id="showQuantity" disabled="disabled">
          </div><!-- /.form-group -->

          <div class="form-group">
            <label>Price</label>
            <input class="form-control" id="showPrice" disabled="disabled">
          </div><!-- /.form-group -->

          <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" id="showDescription" disabled="disabled"></textarea>
          </div><!-- /.form-group -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

</div><!-- /#main-page -->
<script>

  document.addEventListener('DOMContentLoaded', () => {
    let DataController  = (function () {
      let getRequest = async function (url) {
        let response = await fetch(url);

        return response.json();
      };

      let postRequest = async function (url, data) {
        let response = await fetch(url, {
          method: 'POST',
          headers : {"Content-Type" : 'application/json'},
          body: JSON.stringify(data),
        });

        return response.json();
      };

      return {
        getRequest  : getRequest,
        postRequest : postRequest,
      }
    })();

    let UIController    = (function () {
      let DOM = {
        loader      : '#loader',
        mainPage    : '#main-page',
        togglePanle : '.togglePanle',
        tableToggle : '.table-toggle',
        usersTable  : '.users-table',
        createCategory : '.create-category',
        editCategory   : '.edit-category',
        deleteCategorySuccess : '#delete-category-success',

        // category table
        categoryTable  : '#category-table',
        tableHeader  : '#table-header',
        productRow   : '.product-row',

        // create category form
        createCategoryForm  : '#createCategoryForm',
        checkedRadioProduct : "input[type='radio'][name='product']:checked",
        checkedRadioUser    : "input[type='radio'][name='user']:checked",
        createCategorySuceess : '#create-category-suceess',
        validationAlert : '.validation-alert',

        // show row data
        showImg : '#showImg',
        showName : '#showName',
        showCategoey : '#showCategoey',
        showQuantity : '#showQuantity',
        showPrice : '#showPrice',
        showDescription : '#showDescription',

        // error
        genericError :'#generic-error',

        // search bar
        searchFields    : '#searchFields',
        searchName      : '#searchName',
        searchCategory  : '#searchCategory',
        searchPrice     : '#searchPrice',

        // Search For Create order
        productCode : '#productCode',
        userEmail   : '#userEmail',
      };

      let panaleToggle = function (elementObj) {
        let target = elementObj.dataset.target;

        $(DOM.togglePanle).slideUp(500);
        $(target).slideDown(500);
      };

      let getOrderFormData = function () {
        return {
          user_id : document.querySelector(DOM.checkedRadioUser).value,
          product_id : document.querySelector(DOM.checkedRadioProduct).value
        }
      };

      let createSuccessMsg = function () {
        $(DOM.createCategorySuceess).slideDown(500);

        setTimeout(() => {
          $(DOM.createCategorySuceess).slideUp(500);
        }, 3000);
      }

      let removeValidationErr = function () {
        $(DOM.validationAlert).remove();
      };

      let showValidationErr = function (key, message) {
        let alert = `
        <div class="alert alert-danger validation-alert" style="padding: 5px; margin-top: 5px">
          ${message}
        </div>
        `;

        $('#'+key).after(alert);
      }

      let drawRow = function (rowObject) {
        let row = `
          <tr class="text-center product-row" id="category-${rowObject.id}">
            <td>${rowObject.name}</td>
            <td>${rowObject.category_name}</td>
            <td>${rowObject.description}</td>
            <td>${rowObject.price}</td>
            <td>${rowObject.quantity}</td>
            <td>${rowObject.created_at}</td>
            <td>
              <button class="btn btn-primary btn-sm show-row" data-id="${rowObject.id}">
                <i class="fa fa-info-circle show-row" data-id="${rowObject.id}" aria-hidden="true"></i>
              </button>

              <button class="btn btn-danger btn-sm delete-category" data-category-id="${rowObject.id}">
                <span class="glyphicon glyphicon-trash delete-category" data-category-id="${rowObject.id}" aria-hidden="true"></span>
              </button>
            </td>
          </tr>
        `;

        $(DOM.tableHeader).after(row);
      };

      let removeAll = function () {
        $(DOM.productRow).remove();
      };

      let removeRow = function (id) {
        $('#category-'+id).remove();
      }

      let hideRow = function (rowSelector) {
        $(rowSelector).css('display', 'none');
      };

      let showErr = function () {
        $(DOM.genericError).slideDown(500);
      };

      let showProducts = function (obj) {
        document.querySelector(DOM.showImg).src = 'http://127.0.0.1:8000/' + obj.photo_link;
        document.querySelector(DOM.showName).value = obj.name;
        document.querySelector(DOM.showDescription).value = obj.description;
        document.querySelector(DOM.showQuantity).value = obj.quantity;
        document.querySelector(DOM.showPrice).value = obj.price;
        document.querySelector(DOM.showCategoey).value = obj.catgorie_name;
      };

      let getSearchFieldsData = function () {
        return {
          name      : document.querySelector(DOM.searchName).value,
          category  : document.querySelector(DOM.searchCategory).value,
          price     : document.querySelector(DOM.searchPrice).value
        };
      };

      let deleteSuccess = function () {
        $(DOM.deleteCategorySuccess).slideDown(500);

        setTimeout(() => {
          $(DOM.deleteCategorySuccess).slideUp(500);
        }, 3000);
      };

      return {
        DOM : DOM,
        panaleToggle        : panaleToggle,
        getOrderFormData   : getOrderFormData,
        createSuccessMsg    : createSuccessMsg,
        removeValidationErr : removeValidationErr,
        showValidationErr : showValidationErr,
        drawRow : drawRow,
        removeAll : removeAll,
        removeRow : removeRow,
        hideRow   : hideRow,
        showErr : showErr,
        showProducts : showProducts,
        getSearchFieldsData : getSearchFieldsData,
        deleteSuccess : deleteSuccess,
      };
    })();

    let MainController  = (function(dataCtr, uiCtr) {
      let DOMString = uiCtr.DOM;

      let getAll = function () {

        dataCtr.getRequest("{{route('orders.get')}}")
        .then(res => {
          console.log(res.response);
          res.response.forEach(obj => {
            uiCtr.drawRow(obj);
          });
        });

      };

      let togglePanle = function () {
        document.querySelector(DOMString.mainPage).addEventListener('click', (e) => {
          if (e.target.classList.contains('table-toggle')) {
            uiCtr.panaleToggle(e.target);
          }// end :: if
        });
      };

      let addOrder = function () {
        document.querySelector(DOMString.createCategoryForm).addEventListener('submit', (e) => {
          e.preventDefault();

          $(DOMString.loader).show(500);
          let data = uiCtr.getOrderFormData();

          dataCtr.postRequest("{{route('orders.store')}}", data)
          .then(res => {
            uiCtr.drawRow(res.response);
            uiCtr.createSuccessMsg();
            $(DOMString.loader).hide(500);
          })
          .catch(err => {
            console.log(err);
            uiCtr.showErr();
          });

        });
      };

      let showRow = function () {
        document.querySelector(DOMString.mainPage).addEventListener('click', (e) => {
          if (e.target.classList.contains('show-row')) {
            let rowId = e.target.dataset.id;

            dataCtr.getRequest(`{{route('products.show')}}?id=${rowId}`)
            .then(res => {
              if (res.flag) {
                uiCtr.showProducts(res.response);
                $('#myModal').modal('toggle');
              }
              else {
                uiCtr.showErr();
              }
            })
            .catch(err => {
              console.log(err);
              uiCtr.showErr();
            });

            console.log(rowId);
          }
        });
      };

      let deleteRow   = function () {
        document.querySelector(DOMString.mainPage).addEventListener('click', (e) => {
          if (e.target.classList.contains('delete-category')) {
            let rowId = e.target.dataset.categoryId;

            dataCtr.postRequest("{{route('orders.destroy')}}", {id : rowId})
            .then(res => {
              uiCtr.removeRow(res.response.id);
              uiCtr.deleteSuccess();
            });
          }// end :: if
        });
      };

      let searchProducts = function () {

        function search (selector, target, inputValue) {
          inputValue = inputValue.split('');

          if (inputValue.length === 0) {
            $(selector).css('display', '');
          }
          else {
            document.querySelectorAll(selector).forEach(element => {
              let targetVal = String($(element).data(target)).split('');

              if (inputValue.length <= targetVal.length) {
                let flag = true;

                for (let i = 0; i < inputValue.length; i++) {
                  if (inputValue[i] != targetVal[i]) {
                    flag = false;
                    break;
                  }
                }// end :: for

                if (flag) {
                  $(element).css('display', '');
                } else {
                  $(element).css('display', 'none');
                }

              }// end :: if
            });
          }
          //
        }// end :: search

        document.querySelector(DOMString.productCode).addEventListener('keyup', (e) => {
          let productCode = e.target.value;

          // uiCtr.hideRow('.product-row');
          search('.product-row', 'code', productCode);
        });

        document.querySelector(DOMString.userEmail).addEventListener('keyup', (e) => {
          let userEmail = e.target.value;

          // uiCtr.hideRow('.user-row');
          search('.user-row', 'email', userEmail);
        });
      };

      function main () {
        // get all data
        getAll();

        // toggle panle
        togglePanle();

        // add new Order
        addOrder();

        // delete row
        deleteRow();

        // show row
        showRow();

        searchProducts();
      }

      return {
        inite : main
      }
    })(DataController, UIController);

    MainController.inite();
  });
</script>
@endsection
