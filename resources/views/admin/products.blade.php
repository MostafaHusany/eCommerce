@extends('layouts.admin')

@section('content')
<div id="main-page">
  <div class="alert alert-danger" id="generic-error" style="display: none">
    <b>There is an error happend while loading the page, please resfresh the page !!</b>
  </div><!-- /.alert -->

  <!-- latest Products -->
  <div class="panel panel-default users-table togglePanle">
    <div class="panel-heading main-color-bg clearfix">
      <h3 class="panel-title pull-left" style="margin-top:5px;">Products</h3>
      <button type="button" class="pull-right btn btn-default btn-sm table-toggle" data-target=".create-category">
        <span class="glyphicon glyphicon-plus"></span> Create Product
      </button>
    </div>

    <div class="container-fluid" id="searchFields" style="margin-top: 10px">
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label>Name</label>
            <input id="searchName" class="form-control" placeholder="Search by name">
          </div><!-- /.form-group -->
        </div><!-- /.col-md-4 -->

        <div class="col-md-4">
          <div class="form-group">
            <label>Category</label>
            <select id="searchCategory" class="form-control">
              <option value=""> -- Serach by category --</option>
              @foreach($categories as $category)
              <option value="{{$category->id}}">{{$category->name}}</option>
              @endforeach
            </select>
          </div><!-- /.form-group -->
        </div><!-- /.col-md-4 -->

        <div class="col-md-4">
          <div class="form-group">
            <label>Price</label>
            <input id="searchPrice" class="form-control" placeholder="Search by name">
          </div><!-- /.form-group -->
        </div><!-- /.col-md-4 -->

      </div><!-- /.row -->
    </div><!-- /.container -->

    <div class="panel-body panal-body-container">

      <div class="alert alert-danger" id="delete-category-failed" style="display: none">
        <b>Products deleted request failed please refresh the page !!</b>
      </div><!-- /.alert -->

      <div class="alert alert-warning" id="delete-category-success" style="display: none">
        <b>Product was successfuly deleted !!</b>
      </div><!-- /.alert -->

      <table class="table table-striped table-hover" id="category-table">
        <tr id="table-header">
          <th class="text-center">Name</th>
          <th class="text-center">Category</th>
          <th class="text-center">Code</th>
          <th class="text-center">Price</th>
          <th class="text-center">Quantity</th>
          <th class="text-center" style="width: 150px;">Control</th>
        </tr>
      </table>
    </div><!-- /.panel-body -->
  </div><!-- /.panel -->

  <!-- Create new products -->
  <div class="panel panel-default create-category togglePanle" style="display: none">
    <div class="panel-heading main-color-bg clearfix">
      <h3 class="panel-title pull-left" style="margin-top:5px;">Create New Product</h3>
      <button type="button" class="pull-right btn btn-default btn-xs table-toggle" data-target=".users-table">
        <span class="glyphicon glyphicon-remove" data-target=".users-table"></span> close
      </button>
    </div>

    <div class="panel-body">
        <!-- message alwer -->
        <div class="alert alert-success" id="create-category-suceess" style="display: none">
          <b>A new Product was created successfuly !!</b>
        </div><!-- /.alert -->

        <form id="createCategoryForm">

          <div class="form-group">
            <label>Categories</label>
            <select class="form-control form-field" id="category">
              @foreach($categories as $category)
              <option value="{{$category->id}}">{{$category->name}}</option>
              @endforeach
            </select>
          </div><!-- /.form-group -->

          <div class="form-group">
            <label>Name</label>
            <input id="name" name="name" class="form-control form-field" style="padding: 0 5px" type="text" !required="!required">
          </div><!-- /.form-group -->

          <div class="form-group">
            <label>Quantity</label>
            <input id="quantity" class="form-control form-field" type="number">
          </div><!-- /.form-group -->

          <div class="form-group">
            <label>Price</label>
            <input id="price" class="form-control form-field" type="number">
          </div><!-- /.form-group -->

          <div class="form-group">
            <label>Description</label>
            <textarea id="description" name="description" class="form-control form-field" style="padding: 0 5px" !required="!required"></textarea>
          </div><!-- /.form-group -->

          <div class="form-group">
            <input id="file" type="file">
          </div><!-- /.form-group -->

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
          body: data,
          redirect: 'follow'
        });

        return response.json();
      };

      let postRequestSec = async function (url, data) {
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
        postRequestSec : postRequestSec
      }
    })();

    let UIController    = (function () {
      let DOM = {
        mainPage    : '#main-page',
        togglePanle : '.togglePanle',
        tableToggle : '.table-toggle',
        usersTable  : '.users-table',
        createCategory : '.create-category',
        editCategory   : '.edit-category',

        // category table
        categoryTable  : '#category-table',
        tableHeader  : '#table-header',
        productRow   : '.product-row',

        // create category form
        createCategoryForm : '#createCategoryForm',
        category    : '#category',
        name        : '#name',
        quantity    : '#quantity',
        price       : '#price',
        description : '#description',
        file        : '#file',
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

      };

      let panaleToggle = function (elementObj) {
        let target = elementObj.dataset.target;

        $(DOM.togglePanle).slideUp(500);
        $(target).slideDown(500);
      };

      let getCreateFormData = function () {
        var formdata = new FormData();

        formdata.append("file", document.querySelector(DOM.file).files[0]);
        formdata.append("category", document.querySelector(DOM.category).value);
        formdata.append("name", document.querySelector(DOM.name).value);
        formdata.append("description", document.querySelector(DOM.description).value);
        formdata.append("quantity", document.querySelector(DOM.quantity).value);
        formdata.append("price", document.querySelector(DOM.price).value);

        return formdata;
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
            <td>${rowObject.code}</td>
            <td>${rowObject.price}</td>
            <td>${rowObject.quantity}</td>
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

      return {
        DOM : DOM,
        panaleToggle        : panaleToggle,
        getCreateFormData   : getCreateFormData,
        createSuccessMsg    : createSuccessMsg,
        removeValidationErr : removeValidationErr,
        showValidationErr : showValidationErr,
        drawRow : drawRow,
        removeAll : removeAll,
        removeRow : removeRow,
        showErr : showErr,
        showProducts : showProducts,
        getSearchFieldsData : getSearchFieldsData
      };
    })();

    let MainController  = (function(dataCtr, uiCtr) {
      let DOMString = uiCtr.DOM;

      let getAll = function () {

        dataCtr.getRequest("{{route('products.get')}}")
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

      let addCategory = function () {
        document.querySelector(DOMString.createCategoryForm).addEventListener('submit', (e) => {
          e.preventDefault();

          // remove old validation error
          uiCtr.removeValidationErr();

          let data = uiCtr.getCreateFormData();

          dataCtr.postRequest("{{route('products.store')}}", data)
          .then(res => {
            console.log(res);
            if (res.flag) {
              uiCtr.createSuccessMsg();
              uiCtr.drawRow(res.response);
            }
            else {
              let keys = Object.keys(res.response);
              keys.forEach((key) => {
                uiCtr.showValidationErr(key, res.response[key]);
              });
            }
          })
          .catch(err => {
            console.log(err);
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

            dataCtr.postRequestSec("{{route('products.destroy')}}", {id : rowId})
            .then(res => {
              uiCtr.removeRow(res.response.id);
            });
          }// end :: if
        });
      };

      let searchProducts = function () {

        function search (data) {
          dataCtr.getRequest(`{{route('products.search')}}?name=${data.name}&category=${data.category}&price=${data.price}`)
          .then(res => {
            if (res.flag) {
              res.response.forEach(obj => {
                uiCtr.drawRow(obj);
              });
            }
          });
        }

        document.querySelector(DOMString.searchFields).addEventListener('change', () => {
          let data = uiCtr.getSearchFieldsData();

          uiCtr.removeAll();
          search(data);
        });

        document.querySelector(DOMString.searchFields).addEventListener('keyup', () => {
          let data = uiCtr.getSearchFieldsData();

          uiCtr.removeAll();
          search(data);
        });
      };

      function main () {
        // get all data
        getAll();

        // toggle panle
        togglePanle();

        // add new category
        addCategory();

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
