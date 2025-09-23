@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Footer Management</h3>
                    <p class="text-muted">Manage your website footer content, links, and social media</p>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.footer.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <!-- Company Info Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="mb-3">Company Information</h5>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="brand_name">Brand Name</label>
                                    <input type="text" class="form-control" id="brand_name" name="brand_name" value="{{ old('brand_name', $footer->brand_name) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="copyright_text">Copyright Text</label>
                                    <input type="text" class="form-control" id="copyright_text" name="copyright_text" value="{{ old('copyright_text', $footer->copyright_text) }}" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $footer->description) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Links Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="mb-3">Quick Links</h5>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="home_link_text">Home Link Text</label>
                                    <input type="text" class="form-control" id="home_link_text" name="home_link_text" value="{{ old('home_link_text', $footer->home_link_text) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="home_link_url">Home Link URL</label>
                                    <input type="text" class="form-control" id="home_link_url" name="home_link_url" value="{{ old('home_link_url', $footer->home_link_url) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="news_link_text">News Link Text</label>
                                    <input type="text" class="form-control" id="news_link_text" name="news_link_text" value="{{ old('news_link_text', $footer->news_link_text) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="news_link_url">News Link URL</label>
                                    <input type="text" class="form-control" id="news_link_url" name="news_link_url" value="{{ old('news_link_url', $footer->news_link_url) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="concerts_link_text">Concerts Link Text</label>
                                    <input type="text" class="form-control" id="concerts_link_text" name="concerts_link_text" value="{{ old('concerts_link_text', $footer->concerts_link_text) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="concerts_link_url">Concerts Link URL</label>
                                    <input type="text" class="form-control" id="concerts_link_url" name="concerts_link_url" value="{{ old('concerts_link_url', $footer->concerts_link_url) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="events_link_text">Events Link Text</label>
                                    <input type="text" class="form-control" id="events_link_text" name="events_link_text" value="{{ old('events_link_text', $footer->events_link_text) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="events_link_url">Events Link URL</label>
                                    <input type="text" class="form-control" id="events_link_url" name="events_link_url" value="{{ old('events_link_url', $footer->events_link_url) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="contact_link_text">Contact Link Text</label>
                                    <input type="text" class="form-control" id="contact_link_text" name="contact_link_text" value="{{ old('contact_link_text', $footer->contact_link_text) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="contact_link_url">Contact Link URL</label>
                                    <input type="text" class="form-control" id="contact_link_url" name="contact_link_url" value="{{ old('contact_link_url', $footer->contact_link_url) }}" required>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Info Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="mb-3">Contact Information</h5>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $footer->address) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $footer->phone) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $footer->email) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="frequency">Frequency</label>
                                    <input type="text" class="form-control" id="frequency" name="frequency" value="{{ old('frequency', $footer->frequency) }}" required>
                                </div>
                            </div>
                        </div>

                        <!-- Social Media Links Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="mb-3">Social Media Links</h5>
                                <p class="text-muted">Enter the full URLs for your social media profiles. Leave empty to hide the icon.</p>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="facebook_url">Facebook URL</label>
                                    <input type="url" class="form-control" id="facebook_url" name="facebook_url" value="{{ old('facebook_url', $footer->facebook_url) }}" placeholder="https://facebook.com/yourpage">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="instagram_url">Instagram URL</label>
                                    <input type="url" class="form-control" id="instagram_url" name="instagram_url" value="{{ old('instagram_url', $footer->instagram_url) }}" placeholder="https://instagram.com/yourprofile">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="twitter_url">Twitter URL</label>
                                    <input type="url" class="form-control" id="twitter_url" name="twitter_url" value="{{ old('twitter_url', $footer->twitter_url) }}" placeholder="https://twitter.com/yourprofile">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="youtube_url">YouTube URL</label>
                                    <input type="url" class="form-control" id="youtube_url" name="youtube_url" value="{{ old('youtube_url', $footer->youtube_url) }}" placeholder="https://youtube.com/yourchannel">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i> Update Footer
                                </button>
                                <a href="{{ route('admin.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-2"></i> Back to Dashboard
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
