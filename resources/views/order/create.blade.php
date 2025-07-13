@extends('app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Add Order</h3>
                <form action="{{ route('order.store') }}" method="POST" class="row g-3 needs-validation" novalidate>
                    @csrf
                    <div class="col-sm-6">
                        <div class="row g-3">
                            <div class="col-sm-12">
                                <label for="name" class="form-label">Code</label>
                                <input type="text" class="form-control" name="order_code" value="{{ $code }}" readonly>
                            </div>
                            <div class="col-sm-12">
                                <label for="end_date" class="form-label">Estimation</label>
                                <input type="date" class="form-control" name="order_end_date" placeholder="Enter your order estimation" required>
                                <div class="invalid-feedback">Please enter your order estimation</div>
                                @error('order_end_date')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-12">
                                <label for="id_service" class="form-label">Service</label>
                                <select id="id_service" class="form-control">
                                    <option value="">Choose Service</option>
                                    @foreach ($services as $service)
                                    <option data-price="{{ $service->price }}" value="{{ $service->id }}">{{ $service->service_name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Please enter your service!</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row g-3">
                            <div class="col-sm-12">
                                <label for="customer" class="form-label">Customer</label>
                                <select name="id_customer" id="customer" class="form-control" required>
                                    <option value="">Choose Customer</option>
                                    @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->customer_name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Please enter your customer!</div>
                            </div>
                            <div class="col-sm-12">
                                <label for="note" class="form-label">Note</label>
                                <textarea class="form-control" name="order_note" id="note" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    <div align="right">
                        <button type="button" class="btn btn-primary" id="addRow">Add Service</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-stripped" id="myTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Service</th>
                                    <th>Price</th>
                                    <th>Qty (kg)</th>
                                    <th>Subtotal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <p><strong>Total : <span class="textTotal"></span></strong></p>
                    <input type="hidden" name="total" class="total">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const addRow = document.querySelector('#addRow');
    const tbody = document.querySelector('#myTable tbody');
    const selectService = document.querySelector('#id_service');
    
    addRow.addEventListener('click', ()=>{
        const optionServices = selectService.options[selectService.selectedIndex];
        if (!selectService.value) {
            alert("Please Select service");
            return;
        }
        const priceService = parseInt(optionServices.dataset.price);
        const nameService = optionServices.textContent;

        const tr = document.createElement('tr');
        let no = 1;
        tr.innerHTML = `
            <td>${no}</td>
            <td><input type="hidden" class="id_services" name="id_service[]" value="${selectService.value}" />${nameService}</td>
            <td><input type="hidden" class="prices" value="${priceService}" />Rp ${priceService.toLocaleString('id-ID')}</td>
            <td><input type="number" step="any" min="1" class="form-control qtys" name="qty[]" value="1"></td>
            <td><input type="hidden" class="subtotals" name="subtotal[]" value="${priceService}" /><span class="textSubtotals">Rp ${priceService.toLocaleString('id-ID')}</span></td>
            <td><button type="button" class="btn btn-danger btn-sm delRow">Delete</button></td>
        `;

        tbody.appendChild(tr);
        no++;
        updateTotal();

        selectService.value = "";
    });

    tbody.addEventListener('click', (e)=>{
        if (e.target.classList.contains('delRow')) {
            const row = e.target.closest('tr');
            row.remove();
            updateNo();
            updateTotal();
        }
    });

    tbody.addEventListener('input', (e)=>{
        if (e.target.classList.contains('qtys')) {
            const row = e.target.closest('tr');
            const price = parseInt(row.querySelector('.prices').value) || 0;
            const qty = parseFloat(e.target.value) || 0;
            const subtotal = price * qty;
            row.querySelector('.subtotals').value = subtotal;
            row.querySelector('.textSubtotals').textContent = `Rp ${subtotal.toLocaleString('id-ID')}`;
            updateTotal();
        }
    });

    function updateNo(){
        const rows = tbody.querySelectorAll('tr');
        rows.forEach((row, index)=>{
            row.cells[0].textContent = index + 1;
        });
        
        no = rows.length + 1;
    }

    function updateTotal(){
        const rows = tbody.querySelectorAll('tr');
        let sum = 0;
        rows.forEach((row, index)=>{
            sum += parseInt(row.querySelector('.subtotals').value);
        });

        document.querySelector('.total').value = sum;
        document.querySelector('.textTotal').textContent = `Rp ${sum.toLocaleString('id-ID')}`;
    }


</script>
@endsection
