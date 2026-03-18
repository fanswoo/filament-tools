import * as esbuild from 'esbuild'
import autoprefixer from 'autoprefixer';
import postcss from 'postcss';
import tailwindcss from 'tailwindcss';
import { sassPlugin } from 'esbuild-sass-plugin';
import tailwindConfig from '../tailwind.config.js';
import { globSync } from 'node:fs';

const isDev = process.argv.includes('--dev');
const isOutfile2 = process.argv.includes('--outfile2');

const watchPaths = tailwindConfig.content.flatMap((pattern) => {
  return globSync(pattern, { ignore: "node_modules/**" });
});

const defaultOptions = {
  define: {
    'process.env.NODE_ENV': isDev ? `'development'` : `'production'`,
  },
  bundle: true,
  platform: 'neutral',
  sourcemap: isDev ? 'inline' : false,
  sourcesContent: isDev,
  minify: !isDev,
  plugins: [
    {
      name: 'watchPlugin',
      setup: function (build) {
        build.onStart(() => {
          console.log(`Build started at ${new Date(Date.now()).toLocaleTimeString()}: ${build.initialOptions.outfile}`)
        })

        build.onEnd((result) => {
          if (result.errors.length > 0) {
            console.log(`Build failed at ${new Date(Date.now()).toLocaleTimeString()}: ${build.initialOptions.outfile}`, result.errors)
          } else {
            console.log(`Build finished at ${new Date(Date.now()).toLocaleTimeString()}: ${build.initialOptions.outfile}`)
          }
        })
      },
    },
    sassPlugin({
      async transform(source, resolveDir) {

        const { css } = await postcss([
          tailwindcss('./tailwind.config.js'),
          autoprefixer,
        ]).process(source, { from: undefined });

        return { loader: "css", contents: css, watchFiles: watchPaths };
      },
    }),
  ],
}

async function compile(options) {
  const optionsWithDefault = {
    ...defaultOptions,
    entryPoints: options.entryPoints,
    outfile: !isOutfile2 ? options.outfile : options.outfile2,
  };
  const context = await esbuild.context(optionsWithDefault)

  if (isDev) {
    await context.watch()
  } else {
    await context.rebuild()
    await context.dispose()
  }
}

export default compile;