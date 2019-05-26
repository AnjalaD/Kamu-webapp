<h3 class="text-center text-dark">Filters</h3>

<form id="filters" method="post">

    <div class="card m-1 p-2">
        <h4 class="text-center text-dark">Search By</h4>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="search_by" id="search_name" value="0" checked>
            <label class="form-check-label" for="search_name">
                Restaurant Name
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="search_by" id="search_address" value="1">
            <label class="form-check-label" for="search_address">
                Address
            </label>
        </div>
    </div>

    <br />

    <div class="card m-1 p-2">
        <h4 class="text-center text-dark">Sort By</h4>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="sort_by" id="sort_name_a" value="0" checked>
            <label class="form-check-label" for="sort_name_a">
                Name A-Z
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="sort_by" id="sort_name_d" value="1">
            <label class="form-check-label" for="sort_name_d">
                Name Z-A
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="sort_by" id="sort_address" value="2">
            <label class="form-check-label" for="sort_price_a">
                Address
            </label>
        </div>
    </div>

    <input type="submit" id="save_filter" class="btn" value="save">
</form>