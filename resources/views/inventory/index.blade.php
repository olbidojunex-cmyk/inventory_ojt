<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">

        </h2>
    </x-slot>
    <style>

    </style>

    <body>
        <div class="inventory_form container mt-4">

            <!-- Button to Open Modal -->
            <button style="font-weight:bold;" type="button" class="btn btn-outline-dark" data-bs-toggle="modal"
                data-bs-target="#category_modal">
                Create Category
            </button>
            <button style="font-weight:bold;" type="button" class="btn btn-primary" data-bs-toggle="modal"
                data-bs-target="#item_modal">
                Add New Item
            </button>

            <!-- Modal -->
            <div class="modal fade" id="category_modal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Create Category</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal Form -->
                        <form action="{{ route('item-category.store') }}" method="POST" class="needs-validation" novalidate>
                            @csrf

                            <!-- Modal Body -->
                            <div class="modal-body">

                                <!-- Category Input -->
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="category_name"
                                        name="item_category_name" placeholder="Enter Category" required>
                                    <label for="category_name">Category Name</label>
                                    <div class="invalid-feedback">
                                        Please enter a category name.
                                    </div>
                                </div>

                                <!-- Category Dropdown -->
                                <div class="mb-3">
                                    <label class="form-label">Show all Category:</label>
                                    <select name="item_category_id" class="form-control">
                                        @foreach ($item_categories as $category)
                                            <option value="{{ $category->item_category_id }}">
                                                {{ $category->item_category_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <!-- Modal Footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-light text-dark"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>


            <div class="modal fade" id="item_modal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Add New Item</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <form action="" method="POST">
                                @csrf

                                <!-- Item Name -->
                                <div class="mb-3">
                                    <label class="form-label">Item Name</label>
                                    <input type="text" name="item_name" class="form-control"
                                        placeholder="Enter Item Name">
                                </div>

                                <!-- Serial Number -->
                                <div class="mb-3">
                                    <label class="form-label">Serial Number</label>
                                    <input type="text" name="item_serialno" class="form-control"
                                        placeholder="Enter Serial Number">
                                </div>

                                <!-- Quantity -->
                                <div class="mb-3">
                                    <label class="form-label">Quantity</label>
                                    <input type="number" name="item_quantity" class="form-control"
                                        placeholder="Enter Quantity">
                                </div>

                                <!-- Remark -->
                                <div class="mb-3">
                                    <label class="form-label">Remark</label>
                                    <select name="item_remark" class="form-control">
                                        <option value="">Select Category</option>
                                        <option value="damage">Damage</option>
                                        <option value="good">Good</option>
                                        <option value="lost">Lost</option>
                                    </select>
                                </div>

                                <!-- Category -->
                                <div class="mb-3">
                                    <label class="form-label">Category</label>
                                    <select name="item_category_id" class="form-control">
                                        <option value="">Select Category</option>
                                        @foreach ($item_categories as $category)
                                            <option value="{{ $category->item_category_id }}">
                                                {{ $category->item_category_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Brand -->
                                <div class="mb-3">
                                    <label class="form-label">Brand</label>
                                    <select name="item_brand_name" class="form-control">
                                        <option value="nokia">Nokia</option>
                                        <option value="honda">Honda</option>
                                    </select>
                                </div>

                                <!-- UOM -->
                                <div class="mb-3">
                                    <label class="form-label">Unit of Measure</label>
                                    <select name="item_uom_name" class="form-control">
                                        <option value="ambot">Ambot</option>
                                        <option value="wala">Wala</option>
                                    </select>
                                </div>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-light text-dark"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Submit</button>

                        </div>

                    </div>
                </div>
            </div>

            <!-- Inventory Table -->
            <div class="table-responsive mt-4">
                <table class="table table-striped table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Brand Name</th>
                            <th>Serial Number</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @forelse($items as $item)
                        <tr>
                            <td>{{ $item->item_name }}</td>
                            <td>{{ $item->category ? $item->category->item_category_name : '-' }}</td>
                            <td>{{ $item->brand ? $item->brand->item_brand_name : '-' }}</td>
                            <td>{{ $item->item_serialno }}</td>
                            <td>{{ $item->item_quantity ?? '-' }}</td>
                            <td>{{ $item->item_remark ?? '-' }}</td>
                            <td>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No Product Found.</td>
                        </tr>
                    @endforelse

                    </tbody>


                </table>
                <div class="d-flex justify-content-center mt-3">
                    {{ $items->links('pagination::bootstrap-4') }}
                </div>
            </div>

        </div>


    </body>
    <script>
        (() => {
            'use strict'

            const forms = document.querySelectorAll('.needs-validation')

            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })();
    </script>
</x-app-layout>
