<?php

$this->title = "Lập phếu đặt cọc"
?>
    <div class="table-toolbar">
        <div class="widget">
            <form id="w0" class="form-inline" action="/main/product-sale/create" method="post" role="form" enctype="multipart/form-data">
                <input type="hidden" name="_csrf" value="Qi5KMTBDOTQuTT5BaCINURt6PmsGE3dnb0otZWYRdlMgZgZfejF8TQ==">                <div class="alert alert-warning alert-dismissible error-summary" style="display:none"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-warning"></i> Vui lòng sửa các lỗi sau</h4><ul></ul></div>
                <br>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group ">Tên sản phẩm
                            <span class="input-icon icon-right">
                             <select style="width: 100%">
                                 <option>Chọn sản phẩm</option>
                                 <option>Sản phẩm 1</option>
                                 <option>Sản phẩm 2</option>
                                 <option>Sản phẩm 3</option>
                             </select>                       </span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <span class="input-icon icon-right">
                         <label>Mã sản phẩm</label>
                            <input disabled style="width: 100%"><span class="select2 select2-container select2-container--bootstrap input-sm" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-productsale-product_category_id-container"><span class="select2-selection__rendered" id="select2-productsale-product_category_id-container"></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>                    </span>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group ">Khách mua
                            <span class="input-icon icon-right">
                             <select style="width: 100%">
                                 <option>Chọn khách mua</option>
                                 <option>Khach 1</option>
                                 <option>Khach 2</option>
                                 <option>Khach 3</option>
                             </select>                       </span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <span class="input-icon icon-right">
                         <label>Mã khách mua</label>
                            <input disabled style="width: 100%"><span class="select2 select2-container select2-container--bootstrap input-sm" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-productsale-product_category_id-container"><span class="select2-selection__rendered" id="select2-productsale-product_category_id-container"><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>                    </span>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group ">Khách mua
                            <span class="input-icon icon-right">
                             <select style="width: 100%">
                                 <option>Chọn khách mua</option>
                                 <option>Khach 1</option>
                                 <option>Khach 2</option>
                                 <option>Khach 3</option>
                             </select>                       </span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <span class="input-icon icon-right">
                         <label>Mã khách mua</label>
                            <input disabled style="width: 100%"><span class="select2 select2-container select2-container--bootstrap input-sm" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-productsale-product_category_id-container"><span class="select2-selection__rendered" id="select2-productsale-product_category_id-container"></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>                    </span>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group ">Tổng giá
                            <span class="input-icon icon-right">
                             <input type="text" id="productsale-acreage" class="form-control" name="ProductSale[acreage]" style="width: 100%;">                         </span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group ">Tiền đặt cọc
                            <span class="input-icon icon-right">
                             <input type="text" id="productsale-acreage" class="form-control" name="ProductSale[acreage]" style="width: 100%;">                         </span>
                        </div>
                    </div>

                </div>
                <br>

                <div class=" pull-right">
                    <div class="btn-group pull-right">
                        <a class="btn btn-success" href="/deposit/index">
                            <i class="fa fa-save"></i>Lưu lại</a>
                        <a class="btn btn-danger" href="/deposit/index"><i class="fa fa-backward"></i>Quay lại</a>
                    </div>
                </div>
            </form>            </div>
    </div>
