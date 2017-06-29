<!DOCTYPE html>
<html>
    <head>
        <title>Probius</title>
        <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                
            	<table id="locauxInf25" class="table table-striped table-hover locauxDestAll">
				    <thead>
				        <tr>
				        	@forelse($champs as $champ)
				        	<th>{{ $champ->new_name }}</th>
				        	@empty
				        	@endforelse
				        </tr>	
				    </thead>
				    <tbody>
				        @forelse($data as $d)
				        <tr>
				        	@forelse($champs as $c)
				        	<td>{{ $d[$c->old_name] }}</td>
				        	@empty
				        	@endforelse
				        </tr>
			            @empty
				        @endforelse
				    </tbody>
				</table>

            </div>
        </div>
    </body>
</html>


