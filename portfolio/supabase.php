<?php
/**
 * Dungca Portfolio - Supabase REST API Helper
 */

class SupabaseClient
{
    private string $url;
    private string $serviceKey;
    private string $anonKey;

    public function __construct(string $url, string $serviceKey, string $anonKey)
    {
        $this->url        = rtrim($url, '/');
        $this->serviceKey = $serviceKey;
        $this->anonKey    = $anonKey;
    }

    // ── Core HTTP request ─────────────────────────────────────────────────────

    private function request(
        string $method,
        string $endpoint,
        ?array $data = null,
        bool   $useServiceKey = true,
        bool   $returnRepresentation = false
    ): array {
        $key  = $useServiceKey ? $this->serviceKey : $this->anonKey;
        $url  = $this->url . '/rest/v1/' . $endpoint;

        $headers = [
            'apikey: '        . $key,
            'Authorization: Bearer ' . $key,
            'Content-Type: application/json',
            'Accept: application/json',
        ];

        if ($returnRepresentation) {
            $headers[] = 'Prefer: return=representation';
        } else {
            $headers[] = 'Prefer: return=minimal';
        }

        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST  => $method,
            CURLOPT_HTTPHEADER     => $headers,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_TIMEOUT        => 30,
        ]);

        if ($data !== null) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlErr  = curl_error($ch);
        curl_close($ch);

        if ($curlErr) {
            return ['success' => false, 'error' => $curlErr, 'code' => 0];
        }

        $decoded = json_decode($response, true);
        $success = $httpCode >= 200 && $httpCode < 300;

        return [
            'success' => $success,
            'data'    => $decoded,
            'code'    => $httpCode,
        ];
    }

    // ── Public API ────────────────────────────────────────────────────────────

    /**
     * SELECT rows. $query is a raw PostgREST query string, e.g.
     *   "email=eq.foo@bar.com&select=id,email,password_hash"
     */
    public function select(string $table, string $query = ''): array
    {
        $endpoint = $table . ($query !== '' ? '?' . $query : '');
        return $this->request('GET', $endpoint);
    }

    /**
     * INSERT a row. Returns the inserted row(s) when $return=true.
     */
    public function insert(string $table, array $data, bool $useServiceKey = true): array
    {
        return $this->request('POST', $table, $data, $useServiceKey, true);
    }
}

// ── Singleton helper ──────────────────────────────────────────────────────────
function supabase(): SupabaseClient
{
    static $client = null;
    if ($client === null) {
        $client = new SupabaseClient(
            SUPABASE_URL,
            SUPABASE_SERVICE_KEY,
            SUPABASE_ANON_KEY
        );
    }
    return $client;
}
