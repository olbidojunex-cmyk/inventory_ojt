<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">

        </h2>
    </x-slot>

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
                        <form action="" method="POST" class="needs-validation" novalidate>
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
    </body>
</x-app-layout>
