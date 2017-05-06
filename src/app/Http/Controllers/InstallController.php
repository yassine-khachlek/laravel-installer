<?php

namespace Yk\LaravelInstaller\App\Http\Controllers;

use Illuminate\Http\Request;

class InstallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fields = array(
            array(
                'name' => 'DB_DATABASE',
                'value' => '',
            ),
            array(
                'name' => 'DB_USERNAME',
                'value' => '',
            ),
            array(
                'name' => 'DB_PASSWORD',
                'value' => '',
            ),
            array(
                'name' => 'DB_HOST',
                'value' => '',
            ),
            array(
                'name' => 'DB_PORT',
                'value' => '3306',
            ),
            array(
                'name' => 'DB_PREFIX',
                'value' => '',
            )
        );

        return view('Yk\LaravelInstaller::install.index', array('fields' => $fields));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     
        $env_example = file(base_path('.env.example'));

        $env_index = array();

        foreach ($env_example as $line_number => $line)
        {

            foreach ($request->except(['_method', '_token']) as $env_key => $env_value)
            {
                if (starts_with($line, $env_key))
                {
                    $env_index[$line_number] = $env_key.'='.$env_value;
                }
            }

            if (starts_with($line, 'APP_KEY')) {

                \Artisan::call('key:generate', [
                    '--no-interaction' => true, '--show' => true
                ]);

                $env_index[$line_number] = 'APP_KEY='.(\Artisan::output());

            }

        }

        $env = array();

        foreach ($env_example as $line_number => $line)
        {
            if( in_array($line_number, array_keys($env_index)) )
            {
                $line = $env_index[$line_number];
            }

            $env[] = str_replace(array("\n", "\r", "\r\n"), array("", "", ""), $line);
        }

        file_put_contents(base_path('.env'), implode(PHP_EOL, $env));

        $output = "";

        \Artisan::call('config:clear', []);

        $output .= (\Artisan::output());

        \Artisan::call('cache:clear', []);

        $output .= (\Artisan::output());

        \Artisan::call('config:cache', []);

        $output .= (\Artisan::output());

        \Artisan::call('migrate:refresh', [
            '--force' => true, '--seed' => true
        ]);

        $output .= (\Artisan::output());

        $output = str_replace(array("\r", "\r\n"), array("\n", "\n"), $output);

        $output = explode("\n", $output);

        $output = array_filter($output);

        return view('Yk\LaravelInstaller::install.store',
            array(
                'env' => file_get_contents(base_path('.env')),
                'output' => $output
            )
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $Request, $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $Request, $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $Request, $id)
    {
        //
    }
}
