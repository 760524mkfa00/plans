<div class="form-group">
    <label for="building_name">Building Name:</label>
    <input type="text" class="form-control" name="building_name" id="building_name" placeholder="Enter Building Name..."
           value="{{ $building->building_name }}">
</div>
<div class="form-group">
    <label for="street">Street:</label>
    <input type="text" class="form-control" name="street" id="street" placeholder="Enter street..."
           value="{{ $building->street }}">
</div>
<div class="form-group">
    <label for="town">Town:</label>
    <input type="text" class="form-control" name="town" id="town" placeholder="Enter town..."
           value="{{ $building->town }}">
</div>
<div class="form-group">
    <label for="postal">Postal Code:</label>
    <input type="text" class="form-control" name="postal" id="postal" placeholder="Enter postal code..."
           value="{{ $building->postal }}">
</div>
<div class="form-group">
    <label for="province">Province:</label>
    <input type="text" class="form-control" name="province" id="province" placeholder="Enter province..."
           value="{{ $building->province }}">
</div>
<div class="form-group">
    <label for="country">Country:</label>
    <input type="text" class="form-control" name="country" id="country" placeholder="Enter Country..."
           value="{{ $building->country }}">
</div>
<div class="form-group">
    <label for="telephone">telephone:</label>
    <input type="text" class="form-control" name="telephone" id="telephone" placeholder="Enter telephone..."
           value="{{ $building->telephone }}">
</div>
<div class="form-group">
    <label for="building_type">Building Type:</label>
    <input type="text" class="form-control" name="building_type" id="building_type" placeholder="Enter building type..."
           value="{{ $building->building_type }}">
</div>
<div class="form-group">
    <label for="description">description:</label>
    <input type="text" class="form-control" name="description" id="description" placeholder="Enter description..."
           value="{{ $building->description }}">
</div>

<div class="form-group">
    <button type="submit" name="submit" value="create" class="btn btn-primary">{{ $submitButtonText }}</button>
</div>
