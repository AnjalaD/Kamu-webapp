<h4 class="text-center text-white">Sort by</h4>

<form id="filters" method="post">
    <div class="card m-1 p-2" style="background-color: rgba(255, 255, 255, 0.93); font-family:Aclonica;">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="sort_by" id="sort_name_a" value="0" checked>
            <label class="form-check-label" for="sort_name_a">
            <i class="fas fa-font" style="color:#9d2525"></i>   - Name A-Z
            </label>
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="sort_by" id="sort_name_d" value="1">
            <label class="form-check-label" for="sort_name_d">
            <i class="fas fa-font" style="color:#9d2525"></i>   - Name Z-A
            </label>
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
    </div>

    <br/>

    <h4 class="text-center text-dark">Filter by</h4>
    <div class="card m-1 p-2">
        <div>
            <label for="price_filter">Price</label>
            <div>
                <span class="font-weight">0</span>
                <input type="range" min="0" max="1000" step="100" value="300" id="price_filter" name="price_filter">
                <span class="font-weight">1000</span>
            </div>
        </div>
    </div>
    <div class="text-center">
        <input type="submit" id="save_filter" class="btn btn-primary my-3" value="Apply Filters">
    </div>
</form>