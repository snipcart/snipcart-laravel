import Vue from 'vue'
import Vuetify from 'vuetify/lib'
import colors from 'vuetify/lib/util/colors'


Vue.use(Vuetify)

const opts = {
    theme: {
        themes: {
            dark: {
                primary: colors.pink,
                secondary: colors.white,
                accent: colors.shades.black,
                error: colors.red.accent3,
            },
        },
        dark: true,
    },
};

export default new Vuetify(opts)
