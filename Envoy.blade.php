@servers(['localhost' => '127.0.0.1'])

@task('foo', ['on' => 'localhost'])
    ls -la
@endtask
