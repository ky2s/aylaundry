<div class="mb-3">
    <label for="service_name" class="form-label">Service Name</label>
    <input type="text" name="service_name" id="service_name" class="form-control" value="{{ old('service_name', $service->service_name ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea name="description" id="description" class="form-control">{{ old('description', $service->description ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label for="price_per_kg" class="form-label">Price per Kg</label>
    <input type="number" step="0.01" name="price_per_kg" id="price_per_kg" class="form-control" value="{{ old('price_per_kg', $service->price_per_kg ?? '') }}">
</div>

<div class="mb-3">
    <label for="price_per_item" class="form-label">Price per Item</label>
    <input type="number" step="0.01" name="price_per_item" id="price_per_item" class="form-control" value="{{ old('price_per_item', $service->price_per_item ?? '') }}">
</div>

<div class="mb-3">
    <label for="estimated_time" class="form-label">Estimated Time (hours)</label>
    <input type="number" name="estimated_time" id="estimated_time" class="form-control" value="{{ old('estimated_time', $service->estimated_time ?? '') }}">
</div>

<div class="mb-3">
    <label for="category_id" class="form-label">Category</label>
    <input type="number" name="category_id" id="category_id" class="form-control" value="{{ old('category_id', $service->category_id ?? '') }}">
</div>

<div class="mb-3">
    <label for="is_active" class="form-label">Status</label>
    <select name="is_active" id="is_active" class="form-control">
        <option value="1" {{ (old('is_active', $service->is_active ?? 1) == 1) ? 'selected' : '' }}>Active</option>
        <option value="0" {{ (old('is_active', $service->is_active ?? 1) == 0) ? 'selected' : '' }}>Inactive</option>
    </select>
</div>

<div class="mb-3">
    <label for="image_url" class="form-label">Image URL</label>
    <input type="text" name="image_url" id="image_url" class="form-control" value="{{ old('image_url', $service->image_url ?? '') }}">
</div>