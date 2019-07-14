
<form id="filters" method="post">
    <div class="card m-1 p-2" style="background-color: rgba(255, 255, 255, 0.93);">
    <h4 class="text-center text-dark">Sort by</h4>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="sort_by" id="sort_name_a" value="0" checked>
            <label class="form-check-label" for="sort_name_a">
            <i class="fas fa-sort-alpha-down" style="color:#9d2525"></i>   - Name A-Z
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="sort_by" id="sort_name_d" value="1">
            <label class="form-check-label" for="sort_name_d">
            <i class="fas fa-sort-alpha-up" style="color:#9d2525"></i>   - Name Z-A
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="sort_by" id="sort_price_a" value="2">
            <label class="form-check-label" for="sort_price_a">
            <i class="fas fa-dollar-sign" style="color:#9d2525"></i>   - Price <i class="fas fa-arrow-up"></i></i>
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="sort_by" id="sort_price_d" value="3">
            <label class="form-check-label" for="sort_price_d">
            <i class="fas fa-dollar-sign" style="color:#9d2525"></i>   - Price <i class="fas fa-arrow-down"></i></i>
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="sort_by" id="sort_rating_d" value="4">
            <label class="form-check-label" for="sort_rating_d">
            <i class="fas fa-star-half-alt" style="color:#9d2525"></i>   - Rating
            </label>
        </div>
    </div>

    <br/>

    
    <div class="card m-1 p-2" style="background-color: rgba(255, 255, 255, 0.93);">
    <h4 class="text-center text-dark">Filter by</h4>
        <div>
            <label for="price_filter"><i class="fas fa-dollar-sign" style="color:#9d2525"></i>  Price</label>
            <div class="text-center">
                <span class="font-weight" style="font-size:0.8rem;">0</span>
                <input type="range" min="0" max="1000" step="100" value="300" id="price_filter" name="price_filter" style="width:50%">
                <span class="font-weight" style="font-size:0.8rem;">1000</span>
            </div>
        </div>
    </div>

    <div class="text-center">
    <input type="submit" id="save_filter" class="btn btn-warning my-3" value="Sort & Filter !">
    </div>
</form>