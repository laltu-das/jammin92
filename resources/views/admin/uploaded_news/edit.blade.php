@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Edit News Article</h2>
    <a href="{{ route('admin.uploaded-news.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left"></i> Back to News
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('admin.uploaded-news.update', $uploaded_news->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('title') is-invalid @enderror" 
                               id="title" 
                               name="title" 
                               value="{{ old('title', $uploaded_news->title) }}" 
                               required 
                               maxlength="255">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Content <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('content') is-invalid @enderror" 
                                  id="content" 
                                  name="content" 
                                  rows="8" 
                                  required>{{ old('content', $uploaded_news->content) }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">You can use HTML formatting in the content area.</div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="source_url" class="form-label">Source URL</label>
                                <input type="url" 
                                       class="form-control @error('source_url') is-invalid @enderror" 
                                       id="source_url" 
                                       name="source_url" 
                                       value="{{ old('source_url', $uploaded_news->source_url) }}" 
                                       maxlength="255">
                                @error('source_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="source_name" class="form-label">Source Name</label>
                                <input type="text" 
                                       class="form-control @error('source_name') is-invalid @enderror" 
                                       id="source_name" 
                                       name="source_name" 
                                       value="{{ old('source_name', $uploaded_news->source_name) }}" 
                                       maxlength="100">
                                @error('source_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="image" class="form-label">Featured Image</label>
                        <input type="file" 
                               class="form-control @error('image') is-invalid @enderror" 
                               id="image" 
                               name="image" 
                               accept="image/jpeg,image/png,image/jpg,image/gif">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            Allowed formats: JPEG, PNG, JPG, GIF (Max: 2MB)<br>
                            Leave empty to keep current image.
                        </div>
                        
                        @if($uploaded_news->image_path)
                            <div class="mt-2">
                                <p class="mb-1">Current Image:</p>
                                <img src="{{ asset('storage/' . $uploaded_news->image_path) }}" 
                                     alt="{{ $uploaded_news->title }}" 
                                     class="img-thumbnail" 
                                     style="max-width: 100%;">
                            </div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="display_order" class="form-label">Display Order</label>
                        <input type="number" 
                               class="form-control @error('display_order') is-invalid @enderror" 
                               id="display_order" 
                               name="display_order" 
                               value="{{ old('display_order', $uploaded_news->display_order) }}" 
                               min="0">
                        @error('display_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Lower numbers appear first.</div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   id="is_active" 
                                   name="is_active" 
                                   value="1" 
                                   {{ old('is_active', $uploaded_news->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Active (Visible on website)
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Published Date</label>
                        <p class="form-control-plaintext">{{ $uploaded_news->published_at->format('M d, Y H:i') }}</p>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.uploaded_news.index') }}" class="btn btn-outline-secondary">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update News Article
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
