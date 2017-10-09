var config = {
	    assetsDir: 'assets',
	    bowerDir: 'vendor/bower_components',
	    production: !!util.env.production,
	    sourceMaps: !util.env.production,
	    webDir: 'web'
};
gulp.task('styles', function() {
	console.log(config.production);
});

gulp.task('default',['styles'], function(){
	    console.log('hello world');
})

