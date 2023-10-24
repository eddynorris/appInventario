
<x-app-layout>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Agregar nueva venta</h3>
        </div>
            <form method="POST" action="{{ route('sales.store') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Usuario</label>
                        <select class="form-control" id="user_id" name="user_id"> 
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="document">DNI</label>
                        <input type="text" class="form-control" id="document" name="document" placeholder="Ingrese DNI">
                    </div>
                    <div class="form-group">
                        <label for="client">Cliente</label>
                        <input type="text" class="form-control" id="client" name="client" placeholder="Nombre del cliente">
                    </div>
                    <div class="form-group">
                        <label for="address">Direccion</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Direccion del cliente">
                    </div>
                    <div class="form-group">
                        <label for="address">Duracion</label>
                        <input type="number" class="form-control" id="duration" name="duration" value="0" min="0" placeholder="Duracion estimada">
                    </div>
                    <div class="form-group">
                        <label for="total_amount">Precio Total</label>
                        <input type="text" class="form-control" id="total_amount" name="total_amount" placeholder="Precio Total" readonly>
                    </div>
                    <div class="form-group">
                        <label for="total_weight">Peso Total</label>
                        <input type="text" class="form-control" id="total_weight" name="total_weight" placeholder="Carga Total" readonly> 
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

                    <div id="cartContainer">
                        <!-- Aquí se irán añadiendo las Cards de los productos -->
                    </div>
                    <div id="hiddenFields">
                        <!-- Aquí se irán añadiendo los campos ocultos por cada producto añadido -->
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
    </script>

</x-app-layout>
