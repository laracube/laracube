module.exports = (api) => {
    const isTest = api.env('test');

    return {
        presets: [
            [
                '@babel/preset-env',
                {
                    targets: {
                        node: 'current',
                    },
                },
            ],
        ],
    };
};
