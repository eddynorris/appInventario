
<x-app-layout>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Agregar nueva venta</h3>
        </div>
            <form method="POST" action="{{ route('sales.store') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        @if(auth()->user()->hasRole('admin'))
                        <label>Usuario</label>
                        <select class="form-control" id="user_id" name="user_id"> 
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ auth()->id() == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @else
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    @endif

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <label for="document">DNI</label>
                                <input type="text" class="form-control" id="document" name="document" placeholder="Ingrese DNI">
                            </div>
                            <div class="col-md-8 col-sm-12">
                                <label for="client">Cliente</label>
                                <input type="text" class="form-control" id="client" name="client" placeholder="Nombre del cliente">
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <label for="address">Direccion</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="Direccion del cliente">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address">Duracion estimada</label>
                        <input type="number" class="form-control" id="duration" name="duration" value="0" min="0" placeholder="Duracion estimada">
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-10 col-sm-12">
                                <label>Producto</label>
                                <select class="form-control" id="product_id">
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" data-price="{{ $product->price }}" data-weight="{{ $product->weight }}" 
                                            data-unit="{{ $product->unit_measure }}" data-container="{{ $product->container }}">
                                            {{ $product->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <label>Cantidad</label>
                                <input type="number" class="form-control" id="quantity" value="1" min="1">
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <button type="button" onclick="addToCart()" class="btn btn-primary btn-lg">
                            <i class="fas fa-cart-plus fa-lg mr-2"></i> Agregar
                        </button>
                    </div>
                    <div class="container-fluid">
                        <div id="cartContainer" class="row">
                            <!-- Aquí se irán añadiendo las Cards de los productos -->
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="total_amount">Precio Total</label>
                        <input type="number" class="form-control" id="total_amount" name="total_amount" min="0" value="0" readonly>
                    </div>
                    <div class="form-group">
                        <label for="total_weight">Peso Total</label>
                        <input type="number" class="form-control" id="total_weight" name="total_weight"  min="0" value="0" readonly> 
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary ">Registrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        let totalAmount = 0;
        let totalWeight = 0;

        const productSelect = document.getElementById('product_id');
        const quantityInput = document.getElementById('quantity');
        const cartContainer = document.getElementById('cartContainer');
        
        function findCardByProductId(productId) {
            return cartContainer.querySelector(`.card[data-product-id="${productId}"]`);
        }

        function addToCart() {
            event.preventDefault();

            const selectedProduct = productSelect.options[productSelect.selectedIndex];
            const productId = selectedProduct.value;
            const productName = selectedProduct.text;
            const unitPrice = parseFloat(selectedProduct.getAttribute('data-price'));
            const unitWeight = parseFloat(selectedProduct.getAttribute('data-weight'));
            const unitContainer = selectedProduct.getAttribute('data-container');
            const unitUnit = selectedProduct.getAttribute('data-unit');
            
            const quantity = parseFloat(quantityInput.value);

            let card = findCardByProductId(productId);

            if (!card) {
                card = document.createElement('div');
                card.classList.add('card');
                card.classList.add('card-info');
                card.classList.add('col-md-4');

                card.setAttribute('data-product-id', productId);
                card.setAttribute('data-unit-price', unitPrice);
                card.setAttribute('data-unit-weight', unitWeight);
                card.setAttribute('data-quantity', quantity);

                totalAmount += unitPrice * quantity;
                totalWeight += unitWeight * quantity;
            
                document.getElementById('total_amount').value = totalAmount.toFixed(2);
                document.getElementById('total_weight').value = totalWeight.toFixed(2);

                cartContainer.append(card);

                card.innerHTML = `

                        <div class="card-header">
                            <h3 class="card-title">${productName}</h3>
                            <div class="card-tools">
                                <button type="button" onclick="removeProduct(${productId})" class="btn btn-danger">
                                    <i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <label >Cantidad</label>
                                    <input type="hidden" name="products[${productId}][id]" value="${productId}">
                                    <input type="text" name="products[${productId}][quantity]" value="${quantity}" readonly class="form-control-plaintext">
                                </div>
                                <div class="col-4">    
                                    <label >Precio</label>
                                    <input type="text" name="products[${productId}][price]" value="${unitPrice}" readonly class="form-control-plaintext">
                                </div>
                                <div class="col-4">
                                    <label >Peso</label>
                                    <input type="text" name="products[${productId}][weight]" value="${unitWeight}" readonly class="form-control-plaintext">
                                </div>
                                <div class="col-12"> 
                                    <input type="text" readonly class="form-control-plaintext" placeholder="Precio Subtotal: $${(unitPrice * quantity).toFixed(2)}">
                                    <input type="text" readonly class="form-control-plaintext" placeholder="Peso Total: ${(unitWeight * quantity).toFixed(2)}kg">
                                </div>
                            </div>
                        </div>

            `;

            }
            else {
                alert('El producto ya ha sido añadido al carrito.');
            }


        }
        function removeProduct(productId) {
            const card = findCardByProductId(productId);
            
            if (card) {
                const unitPrice = parseFloat(card.getAttribute('data-unit-price'));
                const unitWeight = parseFloat(card.getAttribute('data-unit-weight'));
                const quantity = parseFloat(card.getAttribute('data-quantity'));

                totalAmount -= unitPrice * quantity;
                totalWeight -= unitWeight * quantity;

                document.getElementById('total_weight').value = totalWeight.toFixed(2);
                document.getElementById('total_amount').value = totalAmount.toFixed(2);
                card.remove();
            }
        }
    </script>

</x-app-layout>
