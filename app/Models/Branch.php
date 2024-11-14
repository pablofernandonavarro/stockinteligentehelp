<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Branch extends Model
{
    use HasFactory;

    // Especificamos los campos que pueden ser asignados masivamente
    protected $fillable = ['customer_id', 'branch_name', 'address', 'latitude', 'longitude','any_desk_id'];

    /**
     * Relación: Una sucursal pertenece a un cliente.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Método para obtener las coordenadas de la dirección usando la API de Google.
     */
    public function setCoordinatesFromAddress()
    {
        $address = urlencode($this->address);
        $apiKey = 'YOUR_GOOGLE_MAPS_API_KEY'; // Coloca tu clave de API aquí
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key={$apiKey}";

        $response = Http::get($url);

        if ($response->successful()) {
            $data = $response->json();
            if (isset($data['results'][0])) {
                $location = $data['results'][0]['geometry']['location'];
                $this->latitude = $location['lat'];
                $this->longitude = $location['lng'];
                $this->save();
            }
        }
    }
}
