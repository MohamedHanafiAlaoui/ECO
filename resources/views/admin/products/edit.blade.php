@extends('admin.layout')

@section('title', 'تحرير المنتج')

@section('content')
<!-- Quill Rich Text Editor Styles -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<div x-data="{ activeTab: 'general' }">
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <!-- Page Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-luxury-black text-right">تحرير المنتج: {{ $product->name }}</h1>
            <div class="flex gap-3">
                <a href="{{ route('home') }}" target="_blank" class="bg-white border border-gray-200 text-gray-700 px-6 py-2.5 rounded-xl font-bold hover:bg-gray-50 transition shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    عرض في المتجر
                </a>
                <button type="submit" class="bg-luxury-wood text-white px-10 py-2.5 rounded-xl font-bold hover:bg-[#6b4423] transition shadow-lg flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                    حفظ التغييرات
                </button>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row-reverse gap-8 text-right">
            <!-- Sidebar (Right side in RTL) -->
            <div class="w-full lg:w-1/3 space-y-6">
                <!-- Visibility -->
                <div class="bg-white rounded-3xl shadow-sm p-6 border border-gray-50">
                    <h2 class="font-bold text-lg mb-4 border-b pb-3">ظهور المنتج</h2>
                    <label class="flex items-center justify-between cursor-pointer group">
                        <span class="text-gray-600 group-hover:text-luxury-wood transition">إظهار المنتج في المتجر</span>
                        <div class="relative inline-block w-12 h-6 transition duration-200 ease-in-out rounded-full bg-gray-200">
                            <input type="checkbox" name="is_active" value="1" {{ $product->is_active ? 'checked' : '' }} class="absolute z-10 w-6 h-6 p-0 m-0 border-0 opacity-0 cursor-pointer peer">
                            <span class="absolute top-0 left-0 w-6 h-6 transition duration-200 ease-in-out transform bg-white rounded-full shadow peer-checked:translate-x-6 peer-checked:bg-luxury-wood"></span>
                        </div>
                    </label>
                </div>

                <!-- Featured -->
                <div class="bg-white rounded-3xl shadow-sm p-6 border border-gray-50">
                    <h2 class="font-bold text-lg mb-4 border-b pb-3">منتج مميز</h2>
                    <label class="flex items-center justify-between cursor-pointer group">
                        <span class="text-gray-600 group-hover:text-luxury-wood transition">عرض في قسم "المختارات"</span>
                        <div class="relative inline-block w-12 h-6 transition duration-200 ease-in-out rounded-full bg-gray-200">
                            <input type="checkbox" name="is_featured" value="1" {{ $product->is_featured ? 'checked' : '' }} class="absolute z-10 w-6 h-6 p-0 m-0 border-0 opacity-0 cursor-pointer peer">
                            <span class="absolute top-0 left-0 w-6 h-6 transition duration-200 ease-in-out transform bg-white rounded-full shadow peer-checked:translate-x-6 peer-checked:bg-luxury-wood"></span>
                        </div>
                    </label>
                </div>

                <!-- Categorization -->
                <div class="bg-white rounded-3xl shadow-sm p-6 border border-gray-50">
                    <h2 class="font-bold text-lg mb-4 border-b pb-3">التصنيف</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-400 mb-2">القسم الأساسي</label>
                            <select name="category_id" required class="w-full bg-gray-50 border-none rounded-xl p-3 text-sm focus:ring-2 focus:ring-luxury-wood/20">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <a href="{{ route('admin.categories') }}" class="text-luxury-wood text-sm font-bold hover:underline block">+ أضف قسماً جديداً</a>
                    </div>
                </div>

                <!-- Storage Info -->
                <div class="bg-white rounded-3xl shadow-sm p-6 border border-gray-50">
                    <h2 class="font-bold text-lg mb-4 border-b pb-3">تفاصيل التخزين</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-400 mb-2">SKU (رمز المنتج)</label>
                            <input type="text" name="sku" value="{{ $product->sku }}" placeholder="مثال: WOOD-001" class="w-full bg-gray-50 border-none rounded-xl p-3 text-sm focus:ring-2 focus:ring-luxury-wood/20">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-400 mb-2">الرمز الشريطي (Barcode)</label>
                            <input type="text" name="barcode" value="{{ $product->barcode }}" placeholder="EAN / UPC" class="w-full bg-gray-50 border-none rounded-xl p-3 text-sm focus:ring-2 focus:ring-luxury-wood/20">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-400 mb-2">الوزن (كجم)</label>
                            <input type="text" name="weight" value="{{ $product->weight }}" placeholder="0.5" class="w-full bg-gray-50 border-none rounded-xl p-3 text-sm focus:ring-2 focus:ring-luxury-wood/20">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content (Left side in RTL) -->
            <div class="w-full lg:w-2/3 space-y-6">
                <!-- Basic Information -->
                <div class="bg-white rounded-3xl shadow-sm p-8 border border-gray-50 space-y-6">
                    <h2 class="text-xl font-bold border-b pb-4">المعلومات الأساسية</h2>
                    
                    <div class="space-y-6">
                        <!-- Product Name -->
                        <div class="form-group">
                            <label class="block text-sm font-bold text-gray-400 mb-2">اسم المنتج</label>
                            <input type="text" name="name" value="{{ $product->name }}" required class="w-full bg-gray-50 border-none rounded-2xl p-4 text-lg font-bold focus:ring-2 focus:ring-luxury-wood/20 shadow-inner" placeholder="الاسم (مثال: قميص صيفي أزرق ..)">
                        </div>
                        
                        <!-- Product Slug -->
                        <div class="form-group">
                            <label class="block text-sm font-bold text-gray-400 mb-2">رابط المنتج</label>
                            <div class="flex flex-row-reverse items-center bg-gray-50 rounded-2xl overflow-hidden border border-gray-100 shadow-inner">
                                <span class="text-gray-400 text-sm px-4 bg-gray-100/50 py-4 border-r">https://{{ request()->getHost() }}/products/</span>
                                <input type="text" name="slug" value="{{ $product->slug }}" class="flex-grow bg-transparent border-none py-4 px-4 text-sm focus:ring-0 text-left dir-ltr font-medium" placeholder="الرابط">
                            </div>
                        </div>

                        <!-- Product Description with Rich Text Editor -->
                        <div class="form-group">
                            <label class="block text-sm font-bold text-gray-400 mb-2">وصف المنتج</label>
                            <div class="bg-gray-50 rounded-2xl overflow-hidden border border-gray-100">
                                <div id="toolbar-container" class="border-b border-gray-200 bg-white"></div>
                                <div id="quill-editor" class="min-h-[300px] p-4 text-gray-700 bg-white">
                                    {!! $product->description !!}
                                </div>
                                <textarea name="description" id="description-textarea" class="hidden">{{ $product->description }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pricing -->
                <div class="bg-white rounded-3xl shadow-sm p-8 border border-gray-50 space-y-6">
                    <h2 class="text-xl font-bold border-b pb-4">التسعير والمخزون</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-400 mb-2">السعر الحالي (ر.س)</label>
                            <input type="number" name="price" value="{{ $product->price }}" step="0.01" required class="w-full bg-gray-50 border-none rounded-xl p-4 font-bold text-luxury-wood focus:ring-2 focus:ring-luxury-wood/20">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-400 mb-2">السعر السابق (مقارنة)</label>
                            <input type="number" name="compare_at_price" value="{{ $product->compare_at_price }}" step="0.01" class="w-full bg-gray-50 border-none rounded-xl p-4 text-gray-400 focus:ring-2 focus:ring-luxury-wood/20">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-400 mb-2">سعر التكلفة</label>
                            <input type="number" name="cost_price" value="{{ $product->cost_price }}" step="0.01" class="w-full bg-gray-50 border-none rounded-xl p-4 focus:ring-2 focus:ring-luxury-wood/20">
                        </div>
                        <div class="md:col-span-3">
                            <label class="block text-sm font-bold text-gray-400 mb-2">المخزون المتوفر</label>
                            <input type="number" name="stock" value="{{ $product->stock }}" required class="w-full bg-gray-50 border-none rounded-xl p-4 focus:ring-2 focus:ring-luxury-wood/20">
                        </div>
                    </div>
                </div>

                <!-- Media -->
                <div class="bg-white rounded-3xl shadow-sm p-8 border border-gray-50 space-y-6">
                    <div class="flex justify-between items-center border-b pb-4">
                        <h2 class="text-xl font-bold">الصور والوسائط</h2>
                        <div class="flex gap-2">
                            <label for="multi-upload" class="bg-luxury-wood/10 text-luxury-wood px-4 py-2 rounded-lg text-sm font-bold cursor-pointer hover:bg-luxury-wood/20 transition">
                                + رفع صور إضافية
                                <input type="file" id="multi-upload" name="images[]" multiple class="hidden">
                            </label>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <label class="block text-sm font-bold text-gray-400">الصورة الرئيسية</label>
                        <div class="flex gap-4 items-start">
                            <div class="w-32 h-32 rounded-2xl border-2 border-dashed border-gray-200 flex items-center justify-center relative overflow-hidden group">
                                @if($product->image)
                                    <img src="{{ asset('storage/'.$product->image) }}" class="absolute inset-0 w-full h-full object-cover">
                                @endif
                                <input type="file" name="image" class="absolute inset-0 opacity-0 cursor-pointer z-10">
                                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                </div>
                            </div>
                            <div class="flex-grow text-gray-400 text-xs py-4">
                                <p>ملاحظة: للحصول على أفضل جودة، استخدم صوراً بحجم 800x800 بكسل.</p>
                                <p class="mt-1">يدعم تنسيقات JPG, PNG, WEBP.</p>
                            </div>
                        </div>

                        @if($product->images && count($product->images) > 0)
                            <label class="block text-sm font-bold text-gray-400 mt-6">معرض الصور</label>
                            <div class="grid grid-cols-4 md:grid-cols-6 gap-4">
                                @foreach($product->images as $img)
                                    <div class="aspect-square rounded-xl overflow-hidden border border-gray-100 relative group">
                                        <img src="{{ asset('storage/'.$img) }}" class="w-full h-full object-cover">
                                        <button type="button" class="absolute top-1 right-1 bg-red-500 text-white p-1 rounded-md opacity-0 group-hover:opacity-100 transition shadow-sm">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- SEO -->
                <div class="bg-white rounded-3xl shadow-sm p-8 border border-gray-50 space-y-6">
                    <h2 class="text-xl font-bold border-b pb-4">تحسين محركات البحث (SEO)</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-400 mb-2">عنوان الميتا (Meta Title)</label>
                            <input type="text" name="meta_title" value="{{ $product->meta_title }}" class="w-full bg-gray-50 border-none rounded-xl p-4 text-sm focus:ring-2 focus:ring-luxury-wood/20" placeholder="اتركه فارغاً لاستخدام اسم المنتج">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-400 mb-2">وصف الميتا (Meta Description)</label>
                            <textarea name="meta_description" rows="3" class="w-full bg-gray-50 border-none rounded-xl p-4 text-sm focus:ring-2 focus:ring-luxury-wood/20" placeholder="وصف جذاب لمحركات البحث...">{{ $product->meta_description }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Scripts for Quill and Custom Logic -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var quill = new Quill('#quill-editor', {
            modules: {
                toolbar: {
                    container: [
                        [{ 'header': [1, 2, 3, 4, false] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        ['blockquote', 'code-block'],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        [{ 'align': [] }],
                        ['link', 'image', 'video'],
                        ['clean']
                    ],
                    handlers: {
                        image: imageHandler
                    }
                }
            },
            placeholder: 'أدخل وصفاً للمنتج...',
            theme: 'snow'
        });

        // Custom Image Handler for uploading to server
        function imageHandler() {
            var input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');
            input.click();

            input.onchange = function() {
                var file = input.files[0];
                var formData = new FormData();
                formData.append('image', file);
                formData.append('_token', '{{ csrf_token() }}');

                // Show loading or something if needed
                fetch('{{ route("admin.editor.upload") }}', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(result => {
                    if (result.url) {
                        const range = quill.getSelection();
                        quill.insertEmbed(range.index, 'image', result.url);
                    }
                })
                .catch(error => {
                    console.error('Error uploading image:', error);
                });
            };
        }

        // Set initial content
        quill.root.innerHTML = `{!! $product->description !!}`;

        // Update hidden textarea on form submit
        var form = document.querySelector('form');
        form.onsubmit = function() {
            var description = document.querySelector('#description-textarea');
            description.value = quill.root.innerHTML;
        };
    });
</script>

<style>
    .dir-ltr { direction: ltr; text-align: left; }
    .ql-editor { text-align: right; min-height: 300px; font-family: inherit; }
    .ql-toolbar.ql-snow { border: none !important; background: #f9fafb; padding: 8px 12px; }
    .ql-container.ql-snow { border: none !important; }
</style>
@endsection

