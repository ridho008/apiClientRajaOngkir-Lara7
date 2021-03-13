<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Cek Ongkir - Raja Ongkir</title>
   <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>

   {{-- Navbar --}}
   <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">RajaOngkir Lara7</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            {{-- <a class="nav-link active" href="#">Home</a> --}}
          </div>
        </div>
     </div>
   </nav>
   {{-- /Navbar --}}

   {{-- Content --}}
   <div class="container mt-5">
      <div class="row">
         <div class="col-md-12">
            <div class="card">
               <form action="{{ url('/') }}" method="get">
                  @csrf
                  <div class="card-body">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                              <label for="nama">Nama</label>
                              <input type="text" name="nama" id="name" class="form-control @error('nama') is-invalid @enderror">
                              @error('nama')
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="province_from">Asal</label>
                              <select name="province_from" id="province_from" class="form-control @error('province_from') is-invalid @enderror">
                                 <option value="">Pilih Provinsi</option>
                                 @foreach($province as $provin)
                                    <option value="{{ $provin->id }}">{{ $provin->province }}</option>
                                 @endforeach
                              </select>
                                 @error('province_from')
                                     <div class="invalid-feedback">{{ $message }}</div>
                                 @enderror
                           </div>
                           <div class="form-group">
                              <select name="origin" id="origin" class="form-control @error('origin') is-invalid @enderror">
                              </select>
                                 @error('origin')
                                     <div class="invalid-feedback">{{ $message }}</div>
                                 @enderror
                           </div>
                           <div class="form-group">
                              <label for="weight">Berat</label>
                              <input type="number" class="form-control @error('weight') is-invalid @enderror" name="weight" id="weight">
                              <small class="muted text-secondary">dalam gram = 1700 / 1.7Kg</small>
                              @error('weight')
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="province_to">Tujuan</label>
                              <select name="province_to" id="province_to" class="form-control @error('province_to') is-invalid @enderror">
                                 <option value="">Pilih Provinsi</option>
                                 @foreach($province as $provin)
                                    <option value="{{ $provin->id }}">{{ $provin->province }}</option>
                                 @endforeach
                              </select>
                              @error('province_to')
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                           </div>
                           <div class="form-group">
                              <select name="destination" id="destination" class="form-control @error('destination') is-invalid @enderror">
                                 <option value="">Pilih Kota</option>
                              </select>
                              @error('destination')
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label for="courier">Kurir</label>
                              <select name="courier" id="courier" class="form-control @error('courier') is-invalid @enderror">
                                 <option value="">Pilih Kurir</option>
                                 <option value="jne">JNE</option>
                                 <option value="tiki">Tiki</option>
                                 <option value="pos">Pos Indonesia</option>
                              </select>
                              @error('courier')
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                              <button type="submit" class="btn btn-primary btn-block">Hitung</button>
                           </div>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
      @if($cekOngkir)
      <div class="row">
         <div class="col">
            <div class="table-responsive">
               <table class="table table-striped">
                  <thead>
                     <tr>
                        <th>Sevice</th>
                        <th>Description</th>
                        <th>Cost</th>
                        <th>Estimation</th>
                        <th>Note</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($cekOngkir as $result)
                        <tr>
                           <td>{{ $result['service'] }}</td>
                           <td>{{ $result['description'] }}</td>
                           <td>{{ $result['cost'][0]['value'] }}</td>
                           <td>{{ $result['cost'][0]['etd'] . " Days" }}</td>
                           <td>
                              @if($result['cost'][0]['note'] == null)
                              <span class="badge badge-info">Note Empty</span>
                              @else
                              {{ $result['cost'][0]['note'] }}
                              @endif
                           </td>
                        </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>
      @endif
   </div>
   {{-- /Content --}}
   <script src="js/jquery-3.5.1.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <script>
      $(function() {
         $('select[name=province_from]').change(function() {
            const province_id = $(this).val();
            // console.log(province_id);
            if(province_id) {
               $.ajax({
                  url: "http://127.0.0.1:8000/getCity/ajax/" + province_id,
                  dataType: "json",
                  type: "get",
                  success: function(data) {
                     console.log(data);
                     $('select[name=origin]').empty();
                     $.each(data, function(key, value) {
                        $('select[name=origin]').append(`<option value="`+ key +`">`+ value +`</option>`);
                     });
                  }
               });
            }
         });


         $('select[name=province_to]').change(function() {
            const province_id = $(this).val();
            // console.log(province_id);
            if(province_id) {
               $.ajax({
                  url: "http://127.0.0.1:8000/getCity/ajax/" + province_id,
                  dataType: "json",
                  type: "get",
                  success: function(data) {
                     console.log(data);
                     $('select[name=destination]').empty();
                     $.each(data, function(key, value) {
                        $('select[name=destination]').append(`<option value="`+ key +`">`+ value +`</option>`);
                     });
                  }
               });
            }
         });
      });
   </script>
</body>
</html>