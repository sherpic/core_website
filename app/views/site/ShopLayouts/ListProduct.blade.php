<div class="main-content-inner">
    <div class="breadcrumbs breadcrumbs-fixed" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="{{URL::route('shop.adminShop')}}">Home</a>
            </li>
            <li class="active">Danh sách sản phẩm</li>
        </ul><!-- /.breadcrumb -->
    </div>

    <div class="page-content">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                <div class="panel panel-info">
                    {{ Form::open(array('method' => 'GET', 'role'=>'form')) }}
                    <div class="panel-body">
                        <div class="form-group col-lg-3">
                            <label for="order_product_name">Tên sản phẩm</label>
                            <input type="text" class="form-control input-sm" id="product_name" name="product_name" placeholder="Tên sản phẩm" @if(isset($search['product_name']) && $search['product_name'] != '')value="{{$search['product_name']}}"@endif>
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="order_status">Trạng thái</label>
                            <select name="product_status" id="product_status" class="form-control input-sm">
                                {{$optionStatus}}
                            </select>
                        </div>
                    </div>
                    <div class="panel-footer text-right">
                        <span class="">
                            <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-search"></i> Tìm kiếm</button>
                        </span>
                    </div>
                    {{ Form::close() }}
                </div>
                @if(sizeof($data) > 0)
                    <div class="span clearfix"> @if($total >0) Có tổng số <b>{{$total}}</b> sản  phẩm @endif </div>
                    <br>
                    <table class="table table-bordered table-hover">
                        <thead class="thin-border-bottom">
                        <tr class="">
                            <th width="5%" class="text-center">STT</th>
                            <th width="10%" class="text-center">Ảnh SP</th>
                            <th width="25%">Thông tin sản phẩm</th>
                            <th width="15%" class="text-left">Giá bán</th>
                            <th width="25%" class="text-left">Mô tả ngắn</th>
                            <th width="10%" class="text-center">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $key => $item)
                            <tr>
                                <td class="text-center">{{ $stt + $key+1 }}</td>
                                <td class="text-center">
                                    <img src="{{ ThumbImg::thumbBaseNormal(CGlobal::FOLDER_PRODUCT, $item->product_id, $item->product_image, 100, 100, '', true, true)}}">
                                </td>
                                <td>
                                    [<b>{{ $item->product_id }}</b>] {{ $item->product_name }}
                                    <br/><b>Danh mục:</b> {{ $item->category_name }}
                                    <br/>Ngày tạo: {{date ('d-m-Y H:i:s',$item->time_created)}}
                                    <br/>Ngày sửa: {{date ('d-m-Y H:i:s',$item->time_update)}}
                                </td>
                                <td>
                                    @if($item->product_price_market > 0)Thị trường: <b class="green">{{ FunctionLib::numberFormat($item->product_price_market) }} đ</b><br/>@endif
                                    Giá bán: <b class="red">{{ FunctionLib::numberFormat($item->product_price_sell) }} đ</b>
                                    @if($item->product_price_input > 0)<br/>Giá nhập: <b class="green">{{ FunctionLib::numberFormat($item->product_price_input) }} đ</b>@endif
                                </td>
                                <td>
                                    @if($item->product_sort_desc != ''){{ $item->product_sort_desc }}@endif
                                </td>
                                <td class="text-center">
                                    @if($item->product_status == CGlobal::status_show)
                                        <i class="fa fa-check fa-2x"></i>
                                    @endif
                                    @if($item->product_status == CGlobal::status_hide)
                                        <i class="fa fa-close fa-2x"></i>
                                    @endif

                                    <a href="{{URL::route('shop.editProduct',array('product_id' => $item->product_id,'product_name' => $item->product_name))}}" title="Sửa sản phẩm"><i class="fa fa-edit fa-2x"></i></a>
                                    <a href="javascript:void(0);" onclick="Admin.deleteItem({{$item->product_id}},3)" title="Xóa sản phẩm"><i class="fa fa-trash fa-2x"></i></a>

                                    <span class="img_loading" id="img_loading_{{$item->product_id}}"></span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-right">
                        {{$paging}}
                    </div>
                @else
                    <div class="alert">
                        Không có dữ liệu
                    </div>
                @endif
            </div>
        </div>
    </div><!-- /.page-content -->
</div>