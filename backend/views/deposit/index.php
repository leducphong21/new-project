<?php

$this->title = "Tổng hợp phiếu đặt cọc";
?>

<div class="page-body">
    <div class="row">
        <div class="tabbable">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="row">


                <div class="tabbable">
                        <div class="table-toolbar">
                            <div class="widget">


                                <div class="btn-group pull-right">
                                    <a class="btn btn-success" href="/deposit/create"><i class="fa fa-plus withe"></i>Thêm mới</a>

                                    <button class="btn btn-danger btnDelete"><i class="fa fa-times withe circular"></i>Xóa</button>
                                </div>
                            </div>
                        </div>
                        <div id="registration-form" style="overflow: scroll">
                            <div id="datas" data-pjax-container="" data-pjax-push-state="" data-pjax-timeout="3000">                        <div id="w1"><table class="table table-striped table-bordered table-hover"><thead>
                                        <tr>
                                            <th><input type="checkbox" class="select-on-check-all" name="selection_all" value="1"></th>
                                            <th><a href="/main/product-sale/index?sort=name" data-sort="name">Mã phiếu</a></th>
                                            <th><a href="/main/product-sale/index?sort=name" data-sort="name">Tên sản phẩm</a></th>
                                            <th><a href="/main/product-sale/index?sort=code" data-sort="code">Mã sản phẩm</a></th>
                                            <th><a href="/main/product-sale/index?sort=product_category_id" data-sort="product_category_id">Khách mua</a></th>
                                            <th><a href="/main/product-sale/index?sort=product_category_id" data-sort="product_category_id">Mã khách mua</a></th>
                                            <th><a href="/main/product-sale/index?sort=product_category_id" data-sort="product_category_id">Chủ sở hữu</a></th>
                                            <th><a href="/main/product-sale/index?sort=product_category_id" data-sort="product_category_id">Mã chủ sở hữu</a></th>
                                            <th><a href="/main/product-sale/index?sort=total_price" data-sort="total_price">Tổng giá</a></th>
                                            <th><a href="/main/product-sale/index?sort=status" data-sort="status">Tiền đặt cọc</a></th>
                                            <th class="action-column">&nbsp;</th></tr><tr id="w1-filters" class="filters"><td>&nbsp;</td><td><input type="text" class="form-control" name="ProductSaleSearch[name]"></td><td><input type="text" class="form-control" name="ProductSaleSearch[name]"></td><td><input type="text" class="form-control" name="ProductSaleSearch[code]"></td><td><input type="text" class="form-control" name="ProductSaleSearch[product_category_id]"></td><td><input type="text" class="form-control" name="ProductSaleSearch[price]"></td><td><input type="text" class="form-control" name="ProductSaleSearch[acreage]"></td><td><input type="text" class="form-control" name="ProductSaleSearch[total_price]"></td><td><input type="text" class="form-control" name="ProductSaleSearch[status]"></td><td><input type="text" class="form-control" name="ProductSaleSearch[status_description]"></td><td>&nbsp;</td></tr>
                                        </thead>
                                        <tbody>
                                        <tr data-key="1">
                                            <td><input type="checkbox" name="selection[]" value="1"></td>
                                            <td style="width:150px;"><a class="alink" href="/main/product-sale/update?id=1">Mã phiếu</a></td>
                                            <td style="width:150px;">San pham 1</td>
                                            <td style="width:70px;">SP001</td>
                                            <td style="width:150px;">Khách 1</td>
                                            <td style="width:90px;">KH001</td>
                                            <td style="width:90px;">Khách 2</td>
                                            <td style="width:90px;">KH002</td>
                                            <td style="width:150px;">10000000000</td>
                                            <td style="width:150px;">20000</td>
                                            <td style="width:250px;text-align:center"><a class="btn btn-info btn-xs edit" href="/main/product-sale/update?id=1" title="Update"><i class="fa fa-edit"></i>Cập nhật</a> <a class="btn btn-danger btn-xs delete" href="/main/product-sale/delete?id=1" title="Delete" data-confirm="Confirm Delete" data-method="post"><i class="fa fa-trash-o"></i>Xóa</a></td></tr>

                                        </tbody></table><br><div class="row"><div class="col-xs-12 col-md-5"><div class="spagination"><div class="summary">Showing <b>1-5</b> of <b>5</b> items.</div></div></div><div class="col-xs-12 col-md-7"><div class="spager"> </div></div></div></div>                        </div>                    </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="activity-modal" class="modal fade" role="dialog">
            <div class="modal-dialog" style="width: 70%">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h4 class="modal-title">Thông tin chi tiết sản phẩm</h4>
                    </div>
                    <div class="modal-body">
                        <table id="show-info">
                            <tbody><tr>
                                <td class="width">
                                    Tên sản phẩm:
                                </td>
                                <td>
                                    <p id="name"></p>
                                </td>
                            </tr>
                            <tr>
                                <td class="width">
                                    Mã sản phẩm:
                                </td>
                                <td>
                                    <p id="code"></p>
                                </td>
                            </tr>
                            <tr>
                                <td class="width">
                                    Loại sản phẩm:
                                </td>
                                <td>
                                    <p id="product_category"></p>
                                </td>
                            </tr>
                            <!--                        <tr>-->
                            <!--                            <td class="width">-->
                            <!--                                Khu vực:-->
                            <!--                            </td>-->
                            <!--                            <td>-->
                            <!--                                <p id="khuvuc"></p>-->
                            <!--                            </td>-->
                            <!--                        </tr>-->
                            <tr>
                                <td class="width">
                                    Địa chỉ:
                                </td>
                                <td>
                                    <p id="address"></p>
                                </td>
                            </tr>
                            <tr>
                                <td class="width">
                                    Giá mét:
                                </td>
                                <td>
                                    <p id="price"></p>
                                </td>
                            </tr>
                            <tr>
                                <td class="width">
                                    Diện tích:
                                </td>
                                <td>
                                    <p id="acreage"></p>
                                </td>
                            </tr>
                            <tr>
                                <td class="width">
                                    Tổng giá:
                                </td>
                                <td>
                                    <p id="total_price"></p>
                                </td>
                            </tr>
                            <tr>
                                <td class="width">
                                    Số tầng
                                </td>
                                <td>
                                    <p id="floors"></p>
                                </td>
                            </tr>
                            <tr>
                                <td class="width">
                                    Tổng số phòng
                                </td>
                                <td>
                                    <p id="rooms"></p>
                                </td>
                            </tr>
                            <tr>
                                <td class="width">
                                    Số phòng ngủ
                                </td>
                                <td>
                                    <p id="bedrooms"></p>
                                </td>
                            </tr>
                            <tr>
                                <td class="width">
                                    Số phòng vệ sinh
                                </td>
                                <td>
                                    <p id="bathrooms"></p>
                                </td>
                            </tr>
                            <tr>
                                <td class="width">
                                    Mô tả:
                                </td>
                                <td>
                                    <p id="description"></p>
                                </td>
                            </tr>
                            </tbody></table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
