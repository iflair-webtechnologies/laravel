<div class="edit-products-overlay">
    <div class="edit-products">
        <form action="" method="post" updateaction="{{ route('global.account.update.products') }}">
            <div class="edit-products-header">
                <h3>Kies hier uw producten en diensten</h3>
                <i class="edit-products-close fa fa-close"></i>
            </div>
            <div class="edit-products-content">
                <ul class="categories">
                    @foreach($categories as $category)
                        <li class="category" id="{{ $category->id }}">{{ $category->name }}</li>
                    @endforeach
                </ul>
                <div class="products-column">
                    <div class="products-selection-intro">
                        <p>Selecteer aan de linkerzijde een categorie.</p>
                    </div>
                    <div class="products-selection">
                        <div>
                            <p>Selecteer uw producten en diensten binnen deze categorie.</p>

                            <p>U kan momenteel gratis maximaal 3 producten selecteren.</p>
                        </div>
                        <div class="products">
                            @foreach($categories as $category)
                                <div class="category" id="{{ $category->id }}">
                                    @foreach($category->products as $product)
                                        <label for="product_{{ $product->id }}" class="product">
                                            <input type="checkbox" name="product[]"
                                                   value="{{ $product->id }}" {{ !$company->products->where('id', $product->id)->isEmpty() ? 'checked' : '' }}
                                                   id="product_{{ $product->id }}">
                                            <span class="label">{{ $product->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="edit-products-footer">
                <div class="opslaan-pijltje">
                    <input type="submit" name="submit_save_products" id="submit-save-products" class="opslaan"
                           value="Opslaan">
                </div>
            </div>
        </form>
    </div>
</div>