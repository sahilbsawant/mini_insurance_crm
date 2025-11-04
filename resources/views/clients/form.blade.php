@csrf
<div class="mb-3">
  <label class="form-label">Name</label>
  <input name="name" value="{{ old('name', $client->name ?? '') }}" class="form-control" required>
  @error('name') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
  <label class="form-label">Email</label>
  <input name="email" value="{{ old('email', $client->email ?? '') }}" class="form-control">
  @error('email') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
  <label class="form-label">Phone</label>
  <input name="phone" value="{{ old('phone', $client->phone ?? '') }}" class="form-control">
</div>

<div class="mb-3">
  <label class="form-label">Address</label>
  <textarea name="address" class="form-control">{{ old('address', $client->address ?? '') }}</textarea>
</div>

<button class="btn btn-success">Save</button>
