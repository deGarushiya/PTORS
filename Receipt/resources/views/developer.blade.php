<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Developer Options</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/icon.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <style>
        body { margin: 0; padding-top: 80px; padding-bottom: 60px; overflow-y: auto;
            font-family: "Lucida Console", "Courier New", monospace;
            background-image: linear-gradient(180deg, rgba(232,238,247,0.85) 0%, rgba(214,223,234,0.85) 50%, rgba(226,232,242,0.85) 100%), url("{{ asset('images/PangasinanBanner_Capitol2.png') }}");
            background-size: 100%, 140%; background-position: center, 8%; background-repeat: no-repeat, no-repeat;
            min-height: 100vh; position: relative; }
        .app-content-layer { position: relative; z-index: 1; }
        nav { list-style-type: none; margin: 0; padding: 15px 0 0 0; background-color: #0d0875; position: fixed; top: 0; width: 100%; }
        .nav img { font-size: 16px; color: #fff; margin: 0 50px 0 50px; border: solid 1px #fff; width: 40px; height: 40px; border-radius: 50%; object-fit: cover; }
        .nav a, .nav .nav-logout-btn { color: #fff; font-size: 20px; font-weight: bold; font-family: "Times New Roman", Times, serif; }
        .nav-link:hover { color: #fff; }
        .active { background-color: #D8E1ED !important; }
        .dev-container { max-width: 900px; margin: 30px auto; padding: 0 20px; }
        .dev-title { font-size: 28px; font-weight: bold; color: #0d0875; margin-bottom: 8px; }
        .dev-subtitle { font-size: 14px; color: #6b7280; margin-bottom: 24px; }
        .dev-panel { background: #fff; border-radius: 12px; padding: 24px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); border: 1px solid rgba(13,8,117,0.1); }
        .dev-nav { display: flex; gap: 8px; margin-bottom: 20px; flex-wrap: wrap; }
        .dev-nav-btn { padding: 10px 20px; border-radius: 8px; border: 1px solid #0d0875; background: #fff; color: #0d0875; font-weight: 600; cursor: pointer; transition: all 0.2s; }
        .dev-nav-btn:hover { background: #f0efff; color: #0d0875; }
        .dev-nav-btn.active { background: #0d0875; color: #fff; border-color: #0d0875; }
        .dev-pane { display: none; }
        .dev-pane.show { display: block; }
        footer { background-color: #0d0875; position: fixed; bottom: 0; width: 100%; text-align: center; font-size: 15px; font-weight: bolder; color: #fff; }
    </style>
</head>
<body>
    <div class="app-content-layer">
    <nav>
        <ul class="nav nav-tabs">
            <div><img src="{{ asset('images/icon.png') }}" alt="Logo"></div>
            <li class="nav-item"><a class="nav-link" href="{{ route('user') }}">New receipt</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('report') }}">View reports</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('admin') }}">Admin</a></li>
            <li class="nav-item"><a class="nav-link active" href="{{ route('developer') }}">Developer</a></li>
            <li class="nav-item ms-auto" style="margin-right: 10px">
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">@csrf<button type="submit" class="nav-link nav-logout-btn">Log out</button></form>
            </li>
        </ul>
    </nav>

    <div class="dev-container">
        <h1 class="dev-title">Developer options</h1>
        <p class="dev-subtitle">Manage dropdown options and system settings.</p>

        @if(session('success'))<div class="alert alert-success mb-3">{{ session('success') }}</div>@endif
        @if(session('error'))<div class="alert alert-danger mb-3">{{ session('error') }}</div>@endif

        <div class="dev-nav">
            <button type="button" class="dev-nav-btn active" data-pane="particulars">Particulars</button>
            <button type="button" class="dev-nav-btn" data-pane="banks">Banks</button>
        </div>

        <div class="dev-panel">
            <div id="pane-particulars" class="dev-pane show">
                <h5 class="mb-3" style="color: #0d0875;">Particulars (receipt form dropdown)</h5>
                <form method="POST" action="{{ route('developer.particulars.store') }}" class="mb-4">
                    @csrf
                    <div class="row g-2 align-items-end">
                        <div class="col-md-6">
                            <label for="new_name" class="form-label">Add new option</label>
                            <input type="text" name="name" id="new_name" class="form-control @error('name') is-invalid @enderror" placeholder="e.g. Other collection" value="{{ old('name') }}" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for="new_modal_type" class="form-label">Modal type</label>
                            <select name="modal_type" id="new_modal_type" class="form-select">
                                <option value="">Simple (amount only)</option>
                                <option value="settlement" {{ old('modal_type') == 'settlement' ? 'selected' : '' }}>Settlement of Cash Advance</option>
                                <option value="liquidation" {{ old('modal_type') == 'liquidation' ? 'selected' : '' }}>Liquidation of Cash Advance</option>
                                \<option value="liquidation" {{ old('modal_type') == 'trust' ? 'selected' : '' }}>Trust Fund</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-success w-100">Add</button>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead><tr><th>Option</th><th>Type</th><th>Status</th><th style="width: 90px;">Action</th></tr></thead>
                        <tbody>
                            @forelse($particulars as $p)
                            <tr class="{{ $p->is_active ? '' : 'table-secondary' }}">
                                <td>{{ $p->name }}</td>
                                <td><span class="badge bg-secondary">{{ $p->modal_type ?? 'simple' }}</span></td>
                                <td>@if($p->is_active)<span class="badge bg-success">Active</span>@else<span class="badge bg-secondary">Inactive</span>@endif</td>
                                <td>
                                    <form method="POST" action="{{ route('developer.particulars.destroy', $p) }}" style="display:inline;" onsubmit="return confirm('Remove?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="text-muted">No particulars yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="pane-banks" class="dev-pane">
                <h5 class="mb-3" style="color: #0d0875;">Banks (Check payment dropdown)</h5>
                <form method="POST" action="{{ route('developer.banks.store') }}" class="mb-4">
                    @csrf
                    <div class="row g-2 align-items-end">
                        <div class="col-md-8">
                            <label for="new_bank_name" class="form-label">Add new bank</label>
                            <input type="text" name="bank_name" id="new_bank_name" class="form-control @error('bank_name') is-invalid @enderror" placeholder="e.g. BDO Unibank" value="{{ old('bank_name') }}" required>
                            @error('bank_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-success w-100">Add</button>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead><tr><th>Bank name</th><th style="width: 90px;">Action</th></tr></thead>
                        <tbody>
                            @forelse($banks as $bank)
                            <tr>
                                <td>{{ $bank->name }}</td>
                                <td>
                                    <form method="POST" action="{{ route('developer.banks.destroy', $bank) }}" style="display:inline;" onsubmit="return confirm('Remove?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="2" class="text-muted">No banks yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <footer><p class="mb-0 pt-2">Designed and Developed by Marzel Yna Carlet &amp; Gerard Garcia</p></footer>
    </div>

    <script>
    document.querySelectorAll('.dev-nav-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var paneId = 'pane-' + this.getAttribute('data-pane');
            document.querySelectorAll('.dev-nav-btn').forEach(function(b) { b.classList.remove('active'); });
            this.classList.add('active');
            document.querySelectorAll('.dev-pane').forEach(function(p) { p.classList.remove('show'); });
            var pane = document.getElementById(paneId);
            if (pane) pane.classList.add('show');
        });
    });
    </script>
</body>
</html>
