import { config, collection, fields } from 'https://unpkg.com';

export default config({
  storage: { kind: 'github', repo: 'ddprnz-wq/pullove' }, // Il tuo repository
  collections: {
    prodotti: collection({
      label: 'Prodotti Amazon',
      slugField: 'titolo',
      path: 'dati/prodotti/*', // Dove verranno salvati i dati dei prodotti
      format: { data: 'json' },
      schema: {
        titolo: fields.string({ label: 'Titolo Prodotto' }),
        link_amazon: fields.string({ label: 'Link Affiliazione Amazon' }),
        prezzo: fields.string({ label: 'Prezzo (€)' }),
        immagine: fields.image({ label: 'Foto Prodotto', publicPath: '/images/uploads/' })
      },
    }),
  },
});