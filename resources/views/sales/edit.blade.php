<x-app-layout>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Editar Venta</h3>
        </div>
        <form method="POST" action="{{ route('sales.update', $sale) }}">
            @csrf
            @method('patch')
            <div class="card-body">
                <div class="form-group">
                    <label>Usuario</label>
                    <select class="form-control" id="user_id" name="user_id">
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $user->id == $sale->user_id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Cliente</label>
                    
                    <select class="form-control" id="client_id" name="client_id"> 
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ $client->id == $sale->client_id ? 'selected' : '' }}>
                                Nombre: {{ $client->name }}   DNI: {{ $client->document }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="address">Duracion</label>
                    <input type="number" class="form-control" id="duration" name="duration" value="{{ $sale->duration }}" placeholder="Duracion estimada">
                </div>
                <div class="form-group">
                    <label for="total_amount">Precio Total</label>
                    <input type="text" class="form-control" id="total_amount" name="total_amount" value="{{ $sale->total_amount }}" readonly>
                </div>
                <div class="form-group">
                    <label for="total_weight">Peso Total</label>
                    <input type="text" class="form-control" id="total_weight" name="total_weight" value="{{ $sale->total_weight }}" readonly> 
                </div>

                <div class="form-group">
                    <label>Producto</label>
                    <div class="row">
                        <div class="col-4">
                            <select class="form-control" id="product_id">
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" data-price="{{ $product->price }}" data-weight="{{ $product->weight }}" 
                                        data-unit="{{ $product->unit_measure }}" data-container="{{ $product->container }}">
                                        {{ $product->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4">
                            <input type="number" class="form-control" id="quantity" value="1" min="1">
                        </div>
                        <div class="col-4">
                            <button type="button" onclick="addToCart()" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Agregar
                            </button>
                        </div>
                    </div>
                </div>
                <div id="preloadedCartContainer">
                    @foreach($saleDetails as $detail)
                        <div class="card" data-product-id="{{ $detail->product_id }}">
                            <div class="card-header">
                                <h3 class="card-title">{{ $detail->product->name }}</h3> 
                                <!-- Suponiendo que tienes una relación product en tu modelo SaleDetail -->
                            </div>
                            <div class="card-body">
                                <p><strong>Cantidad:</strong> {{ $detail->quantity }}</p>
                                <p><strong>Precio Unitario:</strong> ${{ number_format($detail->price, 2) }}</p>
                                <p><strong>Peso:</strong> {{ number_format($detail->product->weight, 2) }}kg</p>
                                <p><strong>Precio Subtotal:</strong> ${{ number_format($detail->subtotal, 2) }}</p>
                                <p><strong>Peso Total:</strong> {{ number_format($detail->product->weight * $detail->quantity, 2) }}kg</p>
                            </div>
                        </div>
                        <!-- Campos ocultos para este producto -->
                        <input type="hidden" name="products[{{ $detail->product_id }}][id]" value="{{ $detail->product_id }}">
                        <input type="hidden" name="products[{{ $detail->product_id }}][quantity]" value="{{ $detail->quantity }}">
                        <input type="hidden" name="products[{{ $detail->product_id }}][price]" value="{{ $detail->price }}">
                        <input type="hidden" name="products[{{ $detail->product_id }}][weight]" value="{{ $detail->product->weight }}">
                    @endforeach
                </div>
                <div id="cartContainer">
                    <!-- Aquí se irán añadiendo las Cards de los productos -->
                </div>
                <div id="hiddenFields">
                    <!-- Aquí se irán añadiendo los campos ocultos por cada producto añadido -->
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        let totalAmount = 0;
        let totalWeight = 0;

        const productSelect = document.getElementById('product_id');
        const quantityInput = document.getElementById('quantity');
        const cartContainer = document.getElementById('cartContainer');
        const hiddenFieldsContainer = document.getElementById('hiddenFields');
        
        function findCardByProductId(productId) {
            return cartContainer.querySelector(`.card[data-product-id="${productId}"]`);
        }

        function createHiddenInput(name, value) {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = name;
            input.value = value;
            return input;
        }

        function addToCart() {
            event.preventDefault();

            const selectedProduct = productSelect.options[productSelect.selectedIndex];
            const productId = selectedProduct.value;
            const productName = selectedProduct.text;
            const unitPrice = parseFloat(selectedProduct.getAttribute('data-price'));
            const unitWeight = parseFloat(selectedProduct.getAttribute('data-weight'));
            const quantity = parseFloat(quantityInput.value);
            totalAmount += unitPrice * quantity;
            totalWeight += unitWeight * quantity;
            
            let card = findCardByProductId(productId);

            if (!card) {
                card = document.createElement('div');
                card.classList.add('card');
                card.setAttribute('data-product-id', productId);
                
                document.getElementById('total_amount').value = totalAmount.toFixed(2);
                document.getElementById('total_weight').value = totalWeight.toFixed(2);

                cartContainer.append(card);
            }
            else {
                alert('El producto ya ha sido añadido al carrito.');
            }

            card.innerHTML = `
                <div class="card-header">
                    <h3 class="card-title">${productName}</h3>
                    <button onclick="removeProduct(${productId})" style="cursor:pointer; background-color: red; color: white; border: none; float: right;">X</button>
                </div>
                <div class="card-body">
                    <p><strong>Cantidad:</strong> ${quantity}</p>
                    <p><strong>Precio Unitario:</strong> $${unitPrice.toFixed(2)}</p>
                    <p><strong>Peso:</strong> ${unitWeight.toFixed(2)}kg</p>
                    <p><strong>Precio Subtotal:</strong> $${(unitPrice * quantity).toFixed(2)}</p>
                    <p><strong>Peso Total:</strong> ${(unitWeight * quantity).toFixed(2)}kg</p>
                </div>
            `;

            // Añadir campos ocultos
            hiddenFieldsContainer.append(
                createHiddenInput(`products[${productId}][id]`, productId),
                createHiddenInput(`products[${productId}][quantity]`, quantity),
                createHiddenInput(`products[${productId}][price]`, unitPrice),
                createHiddenInput(`products[${productId}][weight]`, unitWeight)
            );
        }
        function findCardByProductId(productId) {
            return cartContainer.querySelector(`.card[data-product-id="${productId}"]`) || 
                   document.getElementById('preloadedCartContainer').querySelector(`.card[data-product-id="${productId}"]`);
        }
        function removeProduct(productId) {
            const card = findCardByProductId(productId);      
                card.remove();
        }

    </script>
</x-app-layout>

