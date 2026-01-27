<?php

namespace Tests\Unit;

use Tests\TestCase;

class EnvironmentConfigurationTest extends TestCase
{
    private string $envExamplePath;
    private array $envVariables;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->envExamplePath = base_path('.env.example');
        $this->envVariables = $this->parseEnvFile($this->envExamplePath);
    }

    /**
     * Parse .env file and return key-value pairs
     */
    private function parseEnvFile(string $path): array
    {
        if (!file_exists($path)) {
            return [];
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $variables = [];

        foreach ($lines as $line) {
            // Skip comments
            if (str_starts_with(trim($line), '#')) {
                continue;
            }

            // Parse key=value pairs
            if (str_contains($line, '=')) {
                [$key, $value] = explode('=', $line, 2);
                $key = trim($key);
                $value = trim($value);
                
                // Remove quotes from value
                $value = trim($value, '"\'');
                
                $variables[$key] = $value;
            }
        }

        return $variables;
    }

    /**
     * Test that .env.example file exists and is readable
     */
    public function test_env_example_file_exists(): void
    {
        $this->assertFileExists($this->envExamplePath);
        $this->assertFileIsReadable($this->envExamplePath);
    }

    /**
     * Test that APP_NAME is set to "Ayuda Stock Inteligente"
     */
    public function test_app_name_is_correctly_set(): void
    {
        $this->assertArrayHasKey('APP_NAME', $this->envVariables);
        $this->assertEquals('Ayuda Stock Inteligente', $this->envVariables['APP_NAME']);
    }

    /**
     * Test that APP_DEBUG is set to false
     */
    public function test_app_debug_is_set_to_false(): void
    {
        $this->assertArrayHasKey('APP_DEBUG', $this->envVariables);
        $this->assertEquals('false', $this->envVariables['APP_DEBUG']);
    }

    /**
     * Test that APP_TIMEZONE is set to America/Argentina/Buenos_Aires
     */
    public function test_app_timezone_is_correctly_set(): void
    {
        $this->assertArrayHasKey('APP_TIMEZONE', $this->envVariables);
        $this->assertEquals('America/Argentina/Buenos_Aires', $this->envVariables['APP_TIMEZONE']);
    }

    /**
     * Test that database host is correctly set
     */
    public function test_database_host_is_correctly_set(): void
    {
        $this->assertArrayHasKey('DB_HOST', $this->envVariables);
        $this->assertEquals('ayuda.stockinteligente.com', $this->envVariables['DB_HOST']);
    }

    /**
     * Test that database name is correctly set
     */
    public function test_database_name_is_correctly_set(): void
    {
        $this->assertArrayHasKey('DB_DATABASE', $this->envVariables);
        $this->assertEquals('ayudastockinteli_ayuda', $this->envVariables['DB_DATABASE']);
    }

    /**
     * Test that database username is correctly set
     */
    public function test_database_username_is_correctly_set(): void
    {
        $this->assertArrayHasKey('DB_USERNAME', $this->envVariables);
        $this->assertEquals('ayudastockinteli_ayudastockintel', $this->envVariables['DB_USERNAME']);
    }

    /**
     * Test that database password is correctly set
     */
    public function test_database_password_is_correctly_set(): void
    {
        $this->assertArrayHasKey('DB_PASSWORD', $this->envVariables);
        $this->assertEquals('stock_2025_ayuda', $this->envVariables['DB_PASSWORD']);
    }

    /**
     * Test that all database connection details match expected values
     */
    public function test_database_connection_details_are_complete(): void
    {
        $expectedDbConfig = [
            'DB_CONNECTION' => 'mysql',
            'DB_HOST' => 'ayuda.stockinteligente.com',
            'DB_PORT' => '3306',
            'DB_DATABASE' => 'ayudastockinteli_ayuda',
            'DB_USERNAME' => 'ayudastockinteli_ayudastockintel',
            'DB_PASSWORD' => 'stock_2025_ayuda',
        ];

        foreach ($expectedDbConfig as $key => $expectedValue) {
            $this->assertArrayHasKey($key, $this->envVariables);
            $this->assertEquals($expectedValue, $this->envVariables[$key]);
        }
    }

    /**
     * Test that APP_KEY is a valid base64 string
     */
    public function test_app_key_is_valid_base64_string(): void
    {
        $this->assertArrayHasKey('APP_KEY', $this->envVariables);
        
        $appKey = $this->envVariables['APP_KEY'];
        
        // Check format: base64:xxxxx
        $this->assertStringStartsWith('base64:', $appKey);
        
        // Extract the actual base64 string
        $base64String = substr($appKey, 7);
        
        // Verify it's valid base64
        $decoded = base64_decode($base64String, true);
        $this->assertNotFalse($decoded, 'APP_KEY should contain a valid base64 string');
        
        // Laravel app keys should be 32 bytes (256 bits) when decoded
        $this->assertEquals(32, strlen($decoded), 'Decoded APP_KEY should be 32 bytes');
    }

    /**
     * Test that LOG_LEVEL is set to debug
     */
    public function test_log_level_is_set_to_debug(): void
    {
        $this->assertArrayHasKey('LOG_LEVEL', $this->envVariables);
        $this->assertEquals('debug', $this->envVariables['LOG_LEVEL']);
    }

    /**
     * Test that all critical environment variables are present
     */
    public function test_all_critical_environment_variables_are_present(): void
    {
        $criticalVars = [
            'APP_NAME',
            'APP_DEBUG',
            'APP_TIMEZONE',
            'DB_HOST',
            'DB_DATABASE',
            'DB_USERNAME',
            'DB_PASSWORD',
            'APP_KEY',
            'LOG_LEVEL',
        ];

        foreach ($criticalVars as $var) {
            $this->assertArrayHasKey($var, $this->envVariables, "Environment variable {$var} is missing");
        }
    }
}
