// /**
//  * Add/update default settings for core blocks
//  *
//  * @link https://docs-lodash.com/v4/merge/ - more on lodash.merge()
//  * @link https://developer.wordpress.org/block-editor/reference-guides/block-api/block-attributes/
//  * @link https://developer.wordpress.org/block-editor/reference-guides/block-api/block-supports/
//  * @param {Object} settings Block settings
//  * @param {String} name The name of the block, e.g. core/quote or acf/cards
//  * @returns {Object}
//  */
//  wp.hooks.addFilter('blocks.registerBlockType', 'reach/theme', (settings, name) => {
//     let blockSettings = {};

//     if (name === 'core/quote') {
//         blockSettings = lodash.merge({}, settings, {
//             supports: {
//                 align: ['left', 'right', 'wide'],
//             },
//         });
//     }

//     return lodash.merge({}, settings, blockSettings);
// });

// wp.hooks.addFilter('blocks.registerBlockType', 'reach/defaults', (settings, name) => {
//     if (name !== 'core/buttons') {
//         return settings;
//     }

//     return lodash.merge({}, settings, {
//         supports: {
//             align: false, // remove all alignments.
//             __experimentalLayout: false, // remove justification and orientation
//         },
//     });
// });
