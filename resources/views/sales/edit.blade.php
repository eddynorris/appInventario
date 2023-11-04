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
                <div class="container-fluid">
                    <div id="cartContainer" class="row">
                        @foreach($saleDetails as $detail)
                            <div class="card card-info col-md-4" 
                                data-product-id="{{ $detail->product_id }}" data-unit-price="{{ $detail->price }}" 
                                data-unit-weight="{{ $detail->product->weight }}" data-quantity="{{ $detail->quantity }}">

                                <div class="card-header">
                                    <h3 class="card-title">{{ $detail->product->name }}</h3>
                                    <div class="card-tools">
                                        <button type="button" onclick="removeProduct({{$detail->product_id}})" class="btn btn-danger">
                                            <i class="fas fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4">
                                            <label >Cantidad</label>
                                            <input type="hidden" name="products[{{ $detail->product_id }}][id]" value="{{ $detail->product_id }}">
                                            <input type="text" name="products[{{ $detail->product_id }}][quantity]" value="{{ $detail->quantity }}" readonly class="form-control-plaintext">
                                        </div>
                                        <div class="col-4">    
                                            <label >Precio</label>
                                            <input type="text" name="products[{{ $detail->product_id }}][price]" value="{{ $detail->price }}" readonly class="form-control-plaintext">
                                        </div>
                                        <div class="col-4">
                                            <label >Peso</label>
                                            <input type="text" name="products[{{ $detail->product_id }}][weight]" value="{{ $detail->product->weight }}" readonly class="form-control-plaintext">
                                        </div>
                                        <div class="col-12"> 
                                            <input type="text" readonly class="form-control-plaintext" placeholder="Precio Subtotal: S/.{{$detail->price * $detail->quantity}}">
                                            <input type="text" readonly class="form-control-plaintext" placeholder="Peso Total: {{$detail->product->weight * $detail->quantity}}kg">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach   
                    </div>
                </div>
                <div id="cartContainer">
                    <!-- Aquí se irán añadiendo las Cards de los productos -->
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </div>
        </form>
    </div>
    <script>

        let totalAmount = parseFloat('{{ $sale->total_amount }}');
        let totalWeight = parseFloat('{{ $sale->total_weight }}');;

        const productSelect = document.getElementById('product_id');
        const quantityInput = document.getElementById('quantity');
        const cartContainer = document.getElementById('cartContainer');

        function validateForm() {
            const productsAdded = cartContainer.children.length;

            if (productsAdded === 0) {
                alert('Por favor, añade al menos un producto antes de registrar.');
                return false;
            }
        
            return true;
        }

        
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

