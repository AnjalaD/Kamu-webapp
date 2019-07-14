
<form id="filters" method="post">

    <div class="card m-1 p-2" style="background-color: rgba(255, 255, 255, 0.93);">
        <h4 class="text-center text-dark">Search By</h4>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="search_by" id="search_name" value="0" checked>
            <label class="form-check-label" for="search_name">
            <i class="fas fa-utensils" style="color:#9d2525;"></i>  - Restaurant Name
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="search_by" id="search_address" value="1">
            <label class="form-check-label" for="search_address">
            <i class="fas fa-map-marker-alt" style="color:#9d2525;"></i>  - Address
            </label>
        </div>
    </div>

    <br />

    <div class="card m-1 p-2" style="background-color: rgba(255, 255, 255, 0.93);">
        <h4 class="text-center text-dark">Sort By</h4>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="sort_by" id="sort_distance_a" value="0">
            <label class="form-check-label" for="sort_distance_a">
            <!-- <i class="fas fa-sort-alpha-down" style="color:#9d2525;"></i> -->
            Nearest
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="sort_by" id="sort_name_a" value="1" checked>
            <label class="form-check-label" for="sort_name_a">
            <i class="fas fa-sort-alpha-down" style="color:#9d2525;"></i>   - Name A-Z
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="sort_by" id="sort_name_d" value="2">
            <label class="form-check-label" for="sort_name_d">
            <i class="fas fa-sort-alpha-up" style="color:#9d2525;"></i>   - Name Z-A
            </label>
        </div>
    </div>

    <div class="text-center">
        <input type="submit" id="save_filter" class="btn btn-warning my-3" value="Sort & Filter !">
    </div>
</form>