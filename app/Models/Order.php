<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $table = 'order';
    protected $primaryKey = 'id_order';
    public $timestamps = false;

    protected $fillable = [
        'id_customer',
        'order_number',
        'order_date',
        'total_amount',
        'status',
        'delivery_address',
        'notes',
        'cancelled_at',
    ];

    protected $casts = [
        'order_date' => 'date',
        'total_amount' => 'decimal:2',
        'cancelled_at' => 'datetime',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'id_customer', 'id_customer');
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'id_order', 'id_order');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'id_order', 'id_order');
    }

    public function formatWaUrl(): ?string
    {
        $this->loadMissing(['items.product.farm.farmer', 'customer.user']);
        $farm = $this->items->first()?->product?->farm;
        $farmer = $farm?->farmer;

        if (! $farmer || blank($farmer->whatsapp_number)) {
            return null;
        }

        $baris = [];
        $baris[] = '*STRUK PESANAN - DariTani.co.id*';
        $baris[] = '';
        $baris[] = 'No. Pesanan: #' . $this->order_number;
        $baris[] = 'Tanggal: ' . ($this->order_date ? $this->order_date->translatedFormat('d F Y') : now()->translatedFormat('d F Y'));
        $baris[] = 'Kebun: ' . ($farm->name_farm ?? '-');
        $baris[] = str_repeat('-', 28);

        foreach ($this->items as $item) {
            $subtotal = $item->qty * $item->price;
            $baris[] = $item->product?->product_name ?? 'Produk';
            $baris[] = (float) $item->qty . ' Kg x Rp' . number_format($item->price, 0, ',', '.')
                . ' = Rp' . number_format($subtotal, 0, ',', '.');
        }

        $baris[] = str_repeat('-', 28);
        $baris[] = '*Total: Rp' . number_format($this->total_amount, 0, ',', '.') . '*';
        $baris[] = '';
        $baris[] = '*Data Pengiriman*';
        $baris[] = 'Nama: ' . ($this->customer?->user?->name_user ?? '-');
        $baris[] = 'No. HP: ' . ($this->customer?->phone ?? '-');
        $baris[] = 'Alamat: ' . ($this->delivery_address ?? $this->customer?->address ?? '-');
        $baris[] = '';
        $baris[] = 'Mohon konfirmasi pesanan ini. Terima kasih!';

        $waNumber = preg_replace('/\D+/', '', $farmer->whatsapp_number);
        if (str_starts_with($waNumber, '0')) {
            $waNumber = '62' . substr($waNumber, 1);
        }

        return 'https://wa.me/' . $waNumber . '?text=' . urlencode(implode("\n", $baris));
    }
}
