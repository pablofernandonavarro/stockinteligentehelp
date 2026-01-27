<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EnvironmentVariablesTest extends TestCase
{
    /**
     * Test that APP_NAME environment variable is accessible in the application
     */
    public function test_app_name_is_accessible(): void
    {
        $appName = config('app.name');
        
        $this->assertNotNull($appName);
        $this->assertIsString($appName);
    }

    /**
     * Test that APP_DEBUG environment variable is accessible and properly typed
     */
    public function test_app_debug_is_accessible(): void
    {
        $appDebug = config('app.debug');
        
        $this->assertNotNull($appDebug);
        $this->assertIsBool($appDebug);
    }

    /**
     * Test that APP_TIMEZONE environment variable is accessible in the application
     */
    public function test_app_timezone_is_accessible(): void
    {
        $timezone = config('app.timezone');
        
        $this->assertNotNull($timezone);
        $this->assertIsString($timezone);
    }

    /**
     * Test that DB_HOST environment variable is accessible in the application
     */
    public function test_db_host_is_accessible(): void
    {
        $dbHost = config('database.connections.mysql.host');
        
        $this->assertNotNull($dbHost);
        $this->assertIsString($dbHost);
    }

    /**
     * Test that DB_DATABASE environment variable is accessible in the application
     */
    public function test_db_database_is_accessible(): void
    {
        $dbDatabase = config('database.connections.mysql.database');
        
        $this->assertNotNull($dbDatabase);
        $this->assertIsString($dbDatabase);
    }

    /**
     * Test that DB_USERNAME environment variable is accessible in the application
     */
    public function test_db_username_is_accessible(): void
    {
        $dbUsername = config('database.connections.mysql.username');
        
        $this->assertNotNull($dbUsername);
        $this->assertIsString($dbUsername);
    }

    /**
     * Test that DB_PASSWORD environment variable is accessible in the application
     */
    public function test_db_password_is_accessible(): void
    {
        $dbPassword = config('database.connections.mysql.password');
        
        // Password can be null in some test environments, so we just check it's defined
        $this->assertTrue(config()->has('database.connections.mysql.password'));
    }

    /**
     * Test that all database connection environment variables are loaded correctly
     */
    public function test_database_connection_variables_are_loaded(): void
    {
        $dbConfig = config('database.connections.mysql');
        
        $this->assertIsArray($dbConfig);
        $this->assertArrayHasKey('host', $dbConfig);
        $this->assertArrayHasKey('database', $dbConfig);
        $this->assertArrayHasKey('username', $dbConfig);
        $this->assertArrayHasKey('password', $dbConfig);
        $this->assertArrayHasKey('port', $dbConfig);
    }

    /**
     * Test that APP_KEY is properly set in the configuration
     */
    public function test_app_key_is_set(): void
    {
        $appKey = config('app.key');
        
        $this->assertNotNull($appKey);
        $this->assertNotEmpty($appKey);
        $this->assertIsString($appKey);
    }

    /**
     * Test that LOG_LEVEL environment variable is accessible
     */
    public function test_log_level_is_accessible(): void
    {
        $logLevel = config('logging.level');
        
        // If log level is not explicitly set in config, check the channel configuration
        if ($logLevel === null) {
            $defaultChannel = config('logging.default');
            $channels = config('logging.channels');
            
            $this->assertNotNull($defaultChannel);
            $this->assertArrayHasKey($defaultChannel, $channels);
        } else {
            $this->assertIsString($logLevel);
        }
    }

    /**
     * Test that environment file path helper works correctly
     */
    public function test_environment_file_helper_works(): void
    {
        $envPath = base_path('.env');
        
        // In testing environment, .env might not exist, but we can check base_path works
        $this->assertIsString($envPath);
        $this->assertStringContainsString('.env', $envPath);
    }

    /**
     * Test that env() helper function works for custom variables
     */
    public function test_env_helper_function_works(): void
    {
        // Test with a default value
        $testValue = env('NON_EXISTENT_VAR', 'default_value');
        
        $this->assertEquals('default_value', $testValue);
    }

    /**
     * Test that critical configuration values are not null
     */
    public function test_critical_config_values_are_not_null(): void
    {
        $criticalConfigs = [
            'app.name',
            'app.key',
            'app.timezone',
            'database.default',
        ];

        foreach ($criticalConfigs as $configKey) {
            $value = config($configKey);
            $this->assertNotNull($value, "Configuration {$configKey} should not be null");
        }
    }
}
