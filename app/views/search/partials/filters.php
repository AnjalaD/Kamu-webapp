<h4 class="text-center text-dark">Sort by</h4>

<form id="filters" method="post">
<div class="card m-1 p-2">
    <div class="form-check">
        <input class="form-check-input" type="radio" name="sort_by" id="sort_name_a" value="1">
        <label class="form-check-label" for="sort_name_a">
            Name A-Z
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="sort_by" id="sort_name_d" value="2">
        <label class="form-check-label" for="sort_name_d">
            Name Z-A
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="sort_by" id="sort_price_a" value="3">
        <label class="form-check-label" for="sort_price_a">
            Price /\
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="sort_by" id="sort_price_d" value="4">
        <label class="form-check-label" for="sort_price_d">
            Price \/
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
            <input type="range" min="0" max="5000" step="100"  value="1000" id="price_filter" name="price_filter">
            <span class="font-weight">5000</span>
        </div>
    </div>
</div>

<input type="submit" id="save_filter" class="btn" value="save">
</form>