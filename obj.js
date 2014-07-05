function DataSet(name, email, skills, location) {
    this.name = name;
    this.email = email;
    this.skills = skills;
    this.location = location;
}
function Skills(base, calc, design, dev, doc, draw, impress, infra, l10n, marketing, math, qa, writer) {
    this.base = base; // 1
    this.calc = calc; // 2
    this.design = base; // 3
    this.dev = dev; // 4
    this.doc = doc; // 5
    this.draw = draw; // 6
    this.impress = impress; // 7
    this.infra = infra; // 8
    this.l10n = l10n; // 9
    this.marketing = marketing; // 10
    this.math = math; // 11
    this.qa = qa; // 12
    this.writer = writer; // 13
}