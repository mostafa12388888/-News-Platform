<div class="card-body">
<form action="{{ route('admin.categories.index') }}" method="get">
    @csrf
    <div class="row">
        <div class="col-2">
            <div class="form-group">
                <select class="form-control" name="searchValue">
                    <option selected disabled>Sort By</option>
                    <option value="id">Id</option>
                    <option value="name">Name</option>
                    <option value="created_at">Created At</option>
                </select>
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                <select class="form-control" name="order">
                <option selected disabled>Order By</option>
                    <option value="asc">Acceding</option>
                    <option value="desc">Descending</option>
                </select>
            </div>
        </div>
        <div class="col-1">
            <div class="form-group">
                <select class="form-control" name="number">
                <option selected disabled>Number Of Row</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="40">40</option>
                </select>
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                <select name="status" class="form-control">
                <option selected disabled>Status</option>

                    <option value="1">Active</option>
                    <option value="0">Not active</option>
                </select>
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                <input type="text" class="form-control" name="keyword" placeholder="Search here">
            </div>
        </div>
        <div class="col-1">
            <div class="form-group">
                <button type="submit" class="btn btn-info">Search</button>
            </div>
        </div>
        <div class="col-2">
        <div class="form-group">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNewCategory">
        Add New Category
        </button>
        </div>
        </div>
    </div>
</form>
</div>
