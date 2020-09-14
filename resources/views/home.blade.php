@extends('layouts.app')

@section('content')
<div class="container-fluid" id="mainPage">
    <div class="row !justify-content-center">
      <div class="col-md-2">
          <div class="list-group">
            <a href="#" class="list-group-item active category-group" data-id="-1">
              All Products
            </a>
            @foreach($categories as $category)
            <a href="#" class="list-group-item category-group" data-id="{{$category->id}}">{{$category->name}}</a>
            @endforeach
          </div><!-- /.list-group -->
        </div><!-- /.col-md-4 -->

        <div class="col-md-10">
            <div class="form-group">
              <input class="form-control" placeholder="Search Products ... ">
            </div><!-- /.form-group -->

            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body" id="">
                    <div class="row" id="productsContainer"></div><!-- /.row -->
                </div><!-- /.col-body -->
            </div><!-- /.card -->
        </div><!-- /.col-10 -->
    </div><!-- /.row -->
</div><!-- /.container -->

<!-- Modal -->
<div class="modal fade" id="showProduct" tabindex="-1" aria-labelledby="showProductLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="itemName"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img class="img-thumbnail" style="width: 100%" id="itemPhoto">
        <hr>
        <b>
          Description : ...
          <p id="itemDescription"></p>
        </b>

        <h4>
          <span>Price :</span>
          <span class="float-right"><i class="fa fa-tag" aria-hidden="true"></i> <span id="itemPrice"></span></span>
        </h4>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="" class="btn btn-primary">Make order</a>
      </div>
    </div>
  </div>
</div>


<script>
  document.addEventListener('DOMContentLoaded', () => {
    let loaclhost = 'http://127.0.0.1:8000/';

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

      let getProductData = function (targetedProduct) {
        return {
          id : targetedProduct.dataset.id,
          name : targetedProduct.dataset.name,
          price : targetedProduct.dataset.price,
          description : targetedProduct.dataset.description,
          photo : targetedProduct.dataset.photo,
        };
      }

      return {
        getRequest  : getRequest,
        postRequest : postRequest,
        getProductData  : getProductData,

      }
    })();

    let UIController    = (function () {

      let DOM = {
        loader        : '#loader',
        mainPage      : '#mainPage',
        categoryGroup : '.category-group',
        categoryRow   : '.category-row',

        // products rows
        listGroupItem     : '.list-group-item',
        productsContainer : '#productsContainer',
        productItem       : '.product-item',
        productItemImg  : '.product-item-img',

        // modal
        showProduct     : '#showProduct',
        itemName        : '#itemName',
        itemDescription : '#itemDescription',
        itemPhoto       : '#itemPhoto',
        itemPrice       : '#itemPrice',

      };

      let removeRow = function () {
        $(DOM.productItem).remove();
      };

      let drawRow = function (object) {
        let row = `
          <div class="col-md-4 product-item" style="margin-top: 10px;cursor: pointer; ">
            <div class="card">
              <div class="card-body">
                <img src="${loaclhost}${object.photo_link}" class="product-item-img img-thumbnail" style="width: 100%;"
                  data-id="${object.id}" data-name="${object.name}" data-price="${object.price}"
                  data-description=${object.description} data-photo="${object.photo_link}">
                <hr>
                <h4>
                  <span>${object.name}</span>
                  <span class="float-right"><i class="fa fa-tag" aria-hidden="true"></i> ${object.price}</span>
                </h4>
              </div><!-- /.card-body -->
            </div><!-- /.card -->
          </div><!-- /.col-md-4 -->
        `;

        $(DOM.productsContainer).append(row);
      };

      let showProductModal = function (data) {
        document.querySelector(DOM.itemName).textContent = data.name;
        document.querySelector(DOM.itemDescription).textContent = data.description;
        document.querySelector(DOM.itemPrice).textContent = data.price;
        document.querySelector(DOM.itemPhoto).src = loaclhost + data.photo;
        $(DOM.showProduct).modal('toggle');
      };

      return {
        DOM : DOM,
        removeRow : removeRow,
        drawRow   : drawRow,
        showProductModal  : showProductModal,
      }
    })();

    let MainController  = (function(dataCtr, uiCtr) {
      let DOMString = uiCtr.DOM;

      let loadProducts = function () {
        // show loading spiner
        $(DOMString.loader).show(500);

        dataCtr.getRequest(`{{route('main.latest')}}`)
        .then(res => {

          if (res.flag) {
            res.response.forEach(obj => {
              uiCtr.drawRow(obj);
            });
          } else {
            // show error
          }

          // remove spining load
          $(DOMString.loader).hide(500);
        })
        .catch(err => {
          console.log(err);
        });
      };

      let toggleCategory = function () {
        document.querySelector(DOMString.mainPage).addEventListener('click', (e) => {
          e.preventDefault();

          if (e.target.classList.contains('category-group')) {
            // remove old rows & show spining load
            uiCtr.removeRow();
            $(DOMString.loader).show(500);

            $(DOMString.listGroupItem).removeClass('active');
            $(e.target).addClass('active');

            let target      = e.target.dataset.id;
            let categoryId  = e.target.dataset.id;

            dataCtr.getRequest(`{{route('main.products')}}?id=${categoryId}`)
            .then(res => {

              if (res.flag) {
                res.response.forEach(obj => {
                  uiCtr.drawRow(obj);
                });
              } else {
                // show error
              }

              // remove spining load
              $(DOMString.loader).hide(500);
            })
            .catch(err => {
              console.log(err);
            });
          }// end :: if
        });
      };// end :: toggleCategory

      let showProduct = function () {
        document.querySelector(DOMString.mainPage).addEventListener('click', (e) => {
          if (e.target.classList.contains('product-item-img')) {
            let productData = dataCtr.getProductData(e.target);
            uiCtr.showProductModal(productData);
          }
        });
      };// end :: showProduct

      function main () {
        // load all products when start the page
        loadProducts();

        // toggle categories
        toggleCategory();

        // show product card
        showProduct();
      }

      return {
        inite : main,
      }
    })(DataController, UIController);

    MainController.inite();

  });
</script>
@endsection
