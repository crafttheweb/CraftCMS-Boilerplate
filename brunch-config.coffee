SRC = 'source'
DIST = 'public'
exports.config =
    paths:
        public: DIST
        watch: [
            SRC
            'test'
            'vendor'
        ]
    npm:
        enabled: true
        globals:
            $: 'jquery'
        jQuery: 'jquery'
    files:
        javascripts:
            joinTo:
                'js/site.js': SRC + '/js/*.js'
                'js/vendor.js': /^node_modules/
            order: 
                before: [ 
                    'node_modules/jquery/dist/jquery.js' 
                ]
        stylesheets: 
            joinTo: 
                'css/app.css': SRC + '/stylesheets/main.scss'
    plugins:
        sass:
            options:
                includePaths: [
                    'node_modules/foundation-sites/scss'
                    'node_modules/motion-ui/src'
                    'node_modules/scut/dist'
                ]
        postcss: 
            processors: [ 
                require('autoprefixer')(browsers: ['last 2 versions' 'ie >= 9'])
            ]
        overrides:
            production:
                optimize: true
                sourceMaps: false
                plugins:
                    autoReload:
                        enabled: false
                cleancss:
                    keepSpecialComments: 0
                    removeEmpty: true
