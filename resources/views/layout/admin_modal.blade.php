<div class="modal fade" id="upload-image" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">上傳圖片</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin/Product/upload-image" method="POST" enctype="multipart/form-data">
                    <input type="hidden" id = "product_id" name = "product_id">
                    <input type="file" id = "product_image" name = "product_image">
                    <input type="submit" value="送出">

                </form>

            </div>
            {{--            <div class="modal-footer">--}}
            {{--                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
            {{--                <button type="button" class="btn btn-primary">Save changes</button>--}}
            {{--            </div>--}}
        </div>
    </div>
</div>



<div class="modal fade" id="import_excel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">匯入Excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin/Product/excel/import" method="POST" enctype="multipart/form-data">
                    <input type="file" id = "excel" name = "excel">
                    <input type="submit" value="送出">

                </form>

            </div>
            {{--            <div class="modal-footer">--}}
            {{--                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
            {{--                <button type="button" class="btn btn-primary">Save changes</button>--}}
            {{--            </div>--}}
        </div>
    </div>
</div>
