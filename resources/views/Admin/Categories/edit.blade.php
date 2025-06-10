<form action="{{ route('admin.categories.update', $category->id) }}" method="post">
@csrf
@method('PUT')
<div class="modal fade" id="editCategory{{ $category->id }}" tabindex="-1"
    role="dialog" aria-labelledby="editCategory{{ $category->id }}Label"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Category
                    :{{ $category->name }}</h5>
                <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" class="form-control" name="name"
                        value="{{ $category->id }}" id="">
                    <br />
                    <select name="status" id="">
                        <option value="1" @selected($category->status)>Active
                        </option>
                        <option value="0" @selected(!$category->status)>Not Active
                        </option>
                    </select>


                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
</form>
