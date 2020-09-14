@extends('layouts.admin')

@section('content')
<div id="main-page">
  <div class="alert alert-danger" id="generic-error" style="display: none">
    <b>There is an error happend while loading the page, please resfresh the page !!</b>
  </div><!-- /.alert -->

  <!-- latest category -->
  <div class="panel panel-default users-table togglePanle">
    <div class="panel-heading main-color-bg clearfix">
      <h3 class="panel-title pull-left" style="margin-top:5px;">Categories</h3>
      <button type="button" class="pull-right btn btn-default btn-sm table-toggle" data-target=".create-category">
        <span class="glyphicon glyphicon-plus"></span> Create Category
      </button>
    </div>

    <div class="panel-body panal-body-container">

      <div class="alert alert-danger" id="delete-category-failed" style="display: none">
        <b>Category deleted request failed please refresh the page !!</b>
      </div><!-- /.alert -->

      <div class="alert alert-warning" id="delete-category-success" style="display: none">
        <b>Category was successfuly deleted !!</b>
      </div><!-- /.alert -->

      <table class="table table-striped table-hover" id="category-table">
        <tr id="table-header">
          <th class="text-center">Name</th>
          <th class="text-center">Description</th>
          <th class="text-center">Number Of Products</th>
          <th class="text-center" style="width: 150px;">Control</th>
        </tr>
      </table>
    </div><!-- /.panel-body -->
  </div><!-- /.panel -->

  <!-- Create new category -->
  <div class="panel panel-default create-category togglePanle" style="display: none">
    <div class="panel-heading main-color-bg clearfix">
      <h3 class="panel-title pull-left" style="margin-top:5px;">Create New Category</h3>
      <button type="button" class="pull-right btn btn-default btn-xs table-toggle" data-target=".users-table">
        <span class="glyphicon glyphicon-remove" data-target=".users-table"></span> close
      </button>
    </div>

    <div class="panel-body">
        <!-- message alwer -->
        <div class="alert alert-success" id="create-category-suceess" style="display: none">
          <b>A new Category was created successfuly !!</b>
        </div><!-- /.alert -->

        <form id="createCategoryForm">

          <div class="form-group">
            <label>Name</label>
            <input id="name" name="name" class="form-control form-field" style="padding: 0 5px" type="text" !required="!required">
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


  <!-- Edit category -->
  <div class="panel panel-default edit-category togglePanle" style="display: none">
    <div class="panel-heading main-color-bg clearfix">
      <h3 class="panel-title pull-left" style="margin-top:5px;">Edit category</h3>
      <button type="button" class="pull-right btn btn-default btn-xs table-toggle" data-target=".users-table">
        <span class="glyphicon glyphicon-remove" data-target=".users-tabler"></span> close
      </button>
    </div>

    <div class="panel-body">
        <!-- message alwer -->
        <div class="alert alert-success" id="edit-form-message-box" style="display: none">
          <b>Account was updated successfuly !!</b>
        </div><!-- /.alert -->

        <form id="editUserForm">
          <div class="form-group">
              <input type="hidden" name="id" value="" id="edit-user-form-id">
              <spna id="id"></span>
          </div><!-- /.form-group -->

          <div class="form-group">
            <label>Category</label>
            <select id="edit-category" name="edit-category" class="form-control form-field" style="padding: 0 5px" type="text" !required="!required">
              <option value="">-- select option --</option>
              <option value="technical">Technical account</option>
              <option value="customer">Customer account</option>
            </select>

          </div><!-- /.form-group -->

          <div class="form-group">
            <label>Name</label>
            <input id="edit-name" name="edit-name" class="form-control form-field" style="padding: 0 5px" type="text" !required="!required">
          </div><!-- /.form-group -->

          <div class="form-group">
            <label>Email</label>
            <input id="edit-email" name="edit-email" class="form-control form-field" style="padding: 0 5px" type="email" !required="!required">
          </div><!-- /.form-group -->

          <div class="form-group">
            <label>Passwornd</label>
            <input id="edit-password" name="edit-password" class="form-control form-field" style="padding: 0 5px" type="password" !required="!required">
          </div><!-- /.form-group -->

          <div class="form-group">
            <label>Re-Passwornd</label>
            <input id="edit-password2" name="edit-password2" class="form-control form-field" style="padding: 0 5px" type="password" !required="!required">
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
            <label>Name</label>
            <input class="form-control" id="showName" disabled="disabled">
          </div><!-- /.form-group -->

          <div class="form-group">
            <label>Quantity</label>
            <input class="form-control" id="showQuantity" disabled="disabled">
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

        // create category form
        createCategoryForm : '#createCategoryForm',
        name        : '#name',
        description : '#description',
        file        : '#file',
        createCategorySuceess : '#create-category-suceess',
        validationAlert : '.validation-alert',

        // show category
        showImg   : '#showImg',
        showName  : '#showName',
        showQuantity : '#showQuantity',
        showDescription : '#showDescription',

      };

      let panaleToggle = function (elementObj) {
        let target = elementObj.dataset.target;

        $(DOM.togglePanle).slideUp(500);
        $(target).slideDown(500);
      };

      let getCreateFormData = function () {
        var formdata = new FormData();

        formdata.append("file", document.querySelector(DOM.file).files[0]);
        formdata.append("name", document.querySelector(DOM.name).value);
        formdata.append("description", document.querySelector(DOM.description).value);

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

      let drawCategoryRow = function (rowObject) {
        let row = `
          <tr class="text-center" id="category-${rowObject.id}">
            <td>${rowObject.name}</td>
            <td>${rowObject.description}</td>
            <td>${rowObject.count}</td>
            <td>
              <button class="btn btn-primary btn-sm show-row" data-id="${rowObject.id}">
                <i class="fa fa-info-circle show-row" data-id="${rowObject.id}" aria-hidden="true"></i>
              </button>

              <button class="btn btn-danger btn-sm delete-category" data-category-id="${rowObject.id}"">
                <span class="glyphicon glyphicon-trash delete-category" data-category-id="${rowObject.id}" aria-hidden="true"></span>
              </button>
            </td>
          </tr>
        `;

        $(DOM.tableHeader).after(row);
      };

      let removeCategoryRow = function (id) {
        $('#category-'+id).remove();
      }

      let showProducts = function (obj) {
        document.querySelector(DOM.showImg).src = 'http://127.0.0.1:8000/' + obj.photo_link;
        document.querySelector(DOM.showName).value = obj.name;
        document.querySelector(DOM.showDescription).value = obj.description;
        document.querySelector(DOM.showQuantity).value = obj.count;
      };

      return {
        DOM : DOM,
        panaleToggle        : panaleToggle,
        getCreateFormData   : getCreateFormData,
        createSuccessMsg    : createSuccessMsg,
        removeValidationErr : removeValidationErr,
        showValidationErr : showValidationErr,
        drawCategoryRow : drawCategoryRow,
        removeCategoryRow : removeCategoryRow,
        showProducts : showProducts,
      };
    })();

    let MainController  = (function(dataCtr, uiCtr) {
      let DOMString = uiCtr.DOM;

      let getAllCategories = function () {

        dataCtr.getRequest("{{route('categories.get')}}")
        .then(res => {
          console.log(res.response);
          res.response.forEach(obj => {
            uiCtr.drawCategoryRow(obj);
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

          dataCtr.postRequest("{{route('categories.store')}}", data)
          .then(res => {
            if (res.flag) {
              uiCtr.createSuccessMsg();
              uiCtr.drawCategoryRow(res.response);
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

      let deleteRow   = function () {
        document.querySelector(DOMString.mainPage).addEventListener('click', (e) => {
          if (e.target.classList.contains('delete-category')) {
            let rowId = e.target.dataset.categoryId;

            dataCtr.postRequestSec("{{route('categories.destroy')}}", {id : rowId})
            .then(res => {
              uiCtr.removeCategoryRow(res.response.id);
            });
          }// end :: if
        });
      };

      let showRow = function () {
        document.querySelector(DOMString.mainPage).addEventListener('click', (e) => {
          if (e.target.classList.contains('show-row')) {
            let rowId = e.target.dataset.id;

            dataCtr.getRequest(`{{route('categories.show')}}?id=${rowId}`)
            .then(res => {
              if (res.flag) {
                uiCtr.showProducts(res.response);
                $('#myModal').modal('toggle');
              }
              else {
                // uiCtr.showErr();
              }
            })
            .catch(err => {
              console.log(err);
              // uiCtr.showErr();
            });

            console.log(rowId);
          }
        });
      };

      function main () {
        // get all data
        getAllCategories();

        // toggle panle
        togglePanle();

        // add new category
        addCategory();

        // delete row
        deleteRow();

        // show row
        showRow();
      }

      return {
        inite : main
      }
    })(DataController, UIController);

    MainController.inite();
  });
</script>
@endsection
